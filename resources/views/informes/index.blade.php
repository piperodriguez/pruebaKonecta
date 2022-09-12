<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<body>
	<h1>Informes</h1>
	<a href="{{ url('/') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
	<ul>
		<li>
			Realizar una consulta que permita conocer cuál es el producto que más stock tiene.
			@forelse ($informe1 as $dato)
				<p>el producto con mayor cantidad es {{$dato->nombreproducto}} actualmente cuanta en el inventario con {{$dato->stock}} unidades disponibles</p>
		     @empty
		       <p>No existen datos para el informe !.</p>
		    @endforelse
		</li>
		<li>
			Realizar una consulta que permita conocer cuál es el producto más vendido.
				<p>el producto mas vendido es {{$informe2['nombre']}} actualmente cuanta en el inventario con {{$informe2['cantidad']['cantidad']}} unidades disponibles</p>

		</li>
	</ul>
</body>