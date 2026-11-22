<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $this->seed(\Database\Seeders\RoleSeeder::class);

        // En MiNegocioApp el registro exige elegir rol: 2 = emprendedora, 3 = cliente
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'rol_id' => 3,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('redirect.role', absolute: false));
    }

    public function test_registration_requires_a_valid_role(): void
    {
        $this->seed(\Database\Seeders\RoleSeeder::class);

        // Sin rol, o con el rol de administrador (1), el registro se rechaza
        foreach ([null, 1] as $rol) {
            $this->post('/register', array_filter([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => 'password',
                'password_confirmation' => 'password',
                'rol_id' => $rol,
            ]))->assertSessionHasErrors('rol_id');
        }

        $this->assertGuest();
    }
}
