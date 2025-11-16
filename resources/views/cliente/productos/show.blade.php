<h2>{{ $product->name }}</h2>
<p>{{ $product->description }}</p>
<p>Precio: {{ $product->price }} COP</p>

<a href="{{ route('cliente.productos.index') }}">Volver al catálogo</a>
