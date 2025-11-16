<h2>Catálogo de Productos</h2>

@foreach($products as $product)
    <div>
        <h3>{{ $product->name }}</h3>
        <p>{{ $product->price }} COP</p>
        <a href="{{ route('cliente.productos.show', $product->id) }}">Ver detalle</a>
    </div>
@endforeach
