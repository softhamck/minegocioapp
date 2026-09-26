<?php

namespace Tests\Feature;

use App\Models\Business;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * Ciclo completo que se evaluará con emprendedoras:
 * negocio -> producto -> compra de la clienta -> gestión del pedido -> informes.
 */
class FlujoPreEncuestaTest extends TestCase
{
    use RefreshDatabase;

    private User $emprendedora;
    private User $clienta;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        DB::table('roles')->insert([['name' => 'Admin'], ['name' => 'Emprendedor'], ['name' => 'Cliente']]);
        $this->emprendedora = User::create(['name' => 'Ana', 'email' => 'ana@test.co', 'password' => bcrypt('x'), 'rol_id' => 2]);
        $this->clienta = User::create(['name' => 'Lu', 'email' => 'lu@test.co', 'password' => bcrypt('x'), 'rol_id' => 3]);
    }

    private function crearNegocioYProducto(array $producto = []): array
    {
        $this->actingAs($this->emprendedora)->post('/emprendedor/business', [
            'name' => 'Tejidos Ana', 'description' => 'Bolsos', 'telephone' => '3001234567',
        ])->assertSessionHasNoErrors();
        $negocio = Business::first();

        $this->actingAs($this->emprendedora)->post("/emprendedor/business/{$negocio->id}/products", array_merge([
            'name' => 'Bolso', 'price' => 45000, 'quantity' => 3, 'active' => '1',
        ], $producto))->assertSessionHasNoErrors();


        return [$negocio, Product::latest('id')->first()];
    }

    public function test_producto_inactivo_se_guarda_inactivo_y_no_aparece_en_catalogo(): void
    {
        [$negocio, $p] = $this->crearNegocioYProducto(['active' => '0']);
        $this->assertFalse((bool) $p->active);

        $this->actingAs($this->clienta)->get('/cliente/productos')->assertOk()->assertDontSee('Bolso');
        $this->actingAs($this->clienta)->get("/cliente/productos/{$p->id}")->assertNotFound();

        $this->actingAs($this->emprendedora)->put("/emprendedor/business/{$negocio->id}/products/{$p->id}", [
            'name' => 'Bolso', 'price' => 45000, 'quantity' => 3, 'active' => '1',
        ]);
        $this->assertTrue((bool) $p->fresh()->active);
    }

    public function test_foto_de_4_mb_se_acepta_y_de_6_mb_se_rechaza_con_mensaje_claro(): void
    {
        Storage::fake('public');
        [$negocio] = $this->crearNegocioYProducto(['image' => UploadedFile::fake()->create('foto.jpg', 4000, 'image/jpeg')]);
        $this->assertNotNull(Product::first()->image);

        $this->actingAs($this->emprendedora)->post("/emprendedor/business/{$negocio->id}/products", [
            'name' => 'Otro', 'price' => 1, 'quantity' => 1, 'active' => '1',
            'image' => UploadedFile::fake()->create('grande.jpg', 6000, 'image/jpeg'),
        ])->assertSessionHasErrors(['image' => 'La foto pesa demasiado. El máximo es 5 MB.']);
    }

    public function test_ciclo_completo_compra_pedido_e_informes(): void
    {
        [$negocio, $p] = $this->crearNegocioYProducto();

        // La clienta ve el producto con el contacto de la tienda y compra 2 unidades
        $this->actingAs($this->clienta)->get("/cliente/productos/{$p->id}")->assertOk()->assertSee('wa.me/573001234567', false);
        $this->actingAs($this->clienta)->post("/cliente/carrito/{$p->id}/add", ['quantity' => 2])->assertRedirect('/cliente/carrito');
        $this->actingAs($this->clienta)->get('/cliente/carrito')->assertOk()->assertSee('Confirmar pedido');
        $r = $this->actingAs($this->clienta)->post('/cliente/carrito/checkout'); fwrite(STDERR, 'DBG '.$r->status().' '.($r->exception?->getMessage()).' '.json_encode(session()->all()).PHP_EOL); $r->assertRedirect('/cliente/pedidos');

        $pedido = Order::first();
        $this->assertSame('pending', $pedido->status);
        $this->assertEquals(90000, $pedido->total);
        $this->assertSame(1, $p->fresh()->quantity);
        $this->assertEmpty(session('cart'));
        $this->actingAs($this->clienta)->get('/cliente/pedidos')->assertOk()->assertSee('Cancelar');
        $this->actingAs($this->clienta)->get("/cliente/pedidos/{$pedido->id}")->assertOk();
        $this->actingAs($this->emprendedora)->get('/emprendedor/orders')->assertOk()->assertSee('Lu');

        $this->actingAs($this->clienta)->get('/cliente/dashboard')->assertOk()->assertSee("Pedido #{$pedido->id}")->assertDontSee('+5% este mes');

        // La emprendedora ve el pedido y lo completa
        $this->actingAs($this->emprendedora)->get("/emprendedor/orders/{$pedido->id}")->assertOk()->assertSee('Lu');
        $this->actingAs($this->emprendedora)->patch("/emprendedor/orders/{$pedido->id}/status", ['status' => 'completed'])
            ->assertRedirect("/emprendedor/orders/{$pedido->id}");
        $this->assertSame('completed', $pedido->fresh()->status);

        // Otra emprendedora no puede ver ese pedido
        $otra = User::create(['name' => 'Otra', 'email' => 'o@test.co', 'password' => bcrypt('x'), 'rol_id' => 2]);
        $this->actingAs($otra)->get("/emprendedor/orders/{$pedido->id}")->assertForbidden();
    }

    public function test_no_se_puede_comprar_mas_del_stock_y_cancelar_devuelve_unidades(): void
    {
        [, $p] = $this->crearNegocioYProducto();
        $this->actingAs($this->clienta)->post("/cliente/carrito/{$p->id}/add", ['quantity' => 3]);
        $p->update(['quantity' => 1]); // otra persona compró antes
        $this->actingAs($this->clienta)->post('/cliente/carrito/checkout')->assertSessionHas('error');
        $this->assertSame(0, Order::count());

        $p->update(['quantity' => 3]);
        $this->actingAs($this->clienta)->post('/cliente/carrito/checkout');
        $pedido = Order::first();
        $this->assertSame(0, $p->fresh()->quantity);

        $this->actingAs($this->emprendedora)->patch("/emprendedor/orders/{$pedido->id}/status", ['status' => 'cancelled']);
        $this->assertSame(3, $p->fresh()->quantity);
        $this->actingAs($this->emprendedora)->patch("/emprendedor/orders/{$pedido->id}/status", ['status' => 'pending'])->assertSessionHas('error');
    }

    public function test_clienta_cancela_pedido_pendiente_y_catalogo_vacio_no_falla(): void
    {
        $this->withoutVite();
        $this->actingAs($this->clienta)->get('/cliente/productos')->assertOk()->assertSee('No hay productos disponibles');
        [, $p] = $this->crearNegocioYProducto();
        $this->actingAs($this->clienta)->post("/cliente/carrito/{$p->id}/add", ['quantity' => 2]);
        $this->actingAs($this->clienta)->post('/cliente/carrito/checkout');
        $pedido = Order::first();
        $this->actingAs($this->clienta)->patch("/cliente/pedidos/{$pedido->id}/cancel")->assertSessionHas('success');
        $this->assertSame('cancelled', $pedido->fresh()->status);
        $this->assertSame(3, $p->fresh()->quantity);
    }

    public function test_paginas_sin_enlaces_rotos_ni_cifras_inventadas(): void
    {
        $this->crearNegocioYProducto();
        $html = $this->actingAs($this->clienta)->get('/cliente/dashboard')->assertOk()->getContent();
        $this->assertStringNotContainsString('cliente.carrito.index', $html);
        $this->assertStringNotContainsString('favoritos', strtolower($html));

        $dash = $this->actingAs($this->emprendedora)->get('/emprendedor/dashboard')->assertOk();
        $dash->assertSee('Bienvenida')->assertSee('Informes')->assertDontSee('Próximamente');

        auth()->logout();
        $this->get('/')->assertOk()->assertDontSee('+80%')->assertDontSee('+95%');
    }

    public function test_buscador_filtro_y_orden_del_catalogo(): void
    {
        [$negocio] = $this->crearNegocioYProducto(['name' => 'Bolso tejido', 'price' => 45000]);
        foreach ([['Aretes de plata', 20000], ['Collar dorado', 80000]] as [$nombre, $precio]) {
            Product::create(['business_id' => $negocio->id, 'name' => $nombre, 'description' => '', 'price' => $precio, 'quantity' => 5, 'active' => 1]);
        }
        $otro = Business::create(['user_id' => $this->emprendedora->id, 'name' => 'Dulces Mía', 'description' => 'x', 'telephone' => '1', 'is_active' => true]);
        Product::create(['business_id' => $otro->id, 'name' => 'Brownie', 'description' => 'chocolate', 'price' => 5000, 'quantity' => 5, 'active' => 1]);

        $this->actingAs($this->clienta)->get('/cliente/productos?buscar=aretes')->assertOk()
            ->assertSee('Aretes de plata')->assertDontSee('Collar dorado');
        $this->actingAs($this->clienta)->get('/cliente/productos?buscar=chocolate')->assertSee('Brownie')->assertDontSee('Bolso tejido');
        $this->actingAs($this->clienta)->get('/cliente/productos?buscar=zzz')->assertSee('No encontramos productos');
        $this->actingAs($this->clienta)->get("/cliente/productos?tienda={$otro->id}")->assertSee('Brownie')->assertDontSee('Aretes de plata');
        $this->actingAs($this->clienta)->get('/cliente/productos?orden=precio_asc')->assertSeeInOrder(['Brownie', 'Aretes de plata', 'Bolso tejido', 'Collar dorado']);
        $this->actingAs($this->clienta)->get('/cliente/productos?orden=precio_desc')->assertSeeInOrder(['Collar dorado', 'Bolso tejido', 'Aretes de plata', 'Brownie']);

        // Orden en "Productos" de la emprendedora
        $this->actingAs($this->emprendedora)->get('/emprendedor/products?sort=price_asc')->assertOk()
            ->assertSeeInOrder(['Brownie', 'Aretes de plata', 'Bolso tejido', 'Collar dorado']);
    }

    public function test_boton_volver_del_producto_lleva_al_catalogo(): void
    {
        [, $p] = $this->crearNegocioYProducto();

        // Entrada directa: vuelve al catálogo completo
        $this->actingAs($this->clienta)->get("/cliente/productos/{$p->id}")
            ->assertSee('href="' . route('cliente.productos.index') . '"', false);

        // Desde una búsqueda: vuelve conservando la búsqueda
        $this->actingAs($this->clienta)->get('/cliente/productos?buscar=bolso');
        $this->actingAs($this->clienta)->get("/cliente/productos/{$p->id}")
            ->assertSee('href="' . e(route('cliente.productos.index') . '?buscar=bolso') . '"', false);
    }

    public function test_panel_admin_y_contador_del_carrito_muestran_datos_reales(): void
    {
        [, $p] = $this->crearNegocioYProducto();
        $admin = User::create(['name' => 'Admin', 'email' => 'admin@test.co', 'password' => bcrypt('x'), 'rol_id' => 1]);
        $this->actingAs($admin)->get('/admin/dashboard')->assertOk()->assertViewHas('totalProducts', 1);

        $this->actingAs($this->clienta)->post("/cliente/carrito/{$p->id}/add", ['quantity' => 2]);
        $this->actingAs($this->clienta)->get('/cliente/dashboard')->assertViewHas('cartCount', 2);
    }
}
