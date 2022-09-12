<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<body>
	<h1>Modulo de pedidos</h1>
	<div class="container">
		
		<a href="{{ url('/') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
			<div class="form-group">
			    <label for="producto">producto</label>
			    <select class="form-control" id="producto">
					@forelse ($datos as $producto)
		   				<option value="{{$producto->id}}">{{$producto->nombreproducto}}</option>
		      		@empty
		        		<p>No hay Productos registrados !.</p>
		    		@endforelse
			    </select>
			</div>
			<div class="form-group">
		       <strong>Cantidad:</strong>
		       <input type="number" name="stock"  id="stock" class="form-control">
		    </div>
		    <div class="form-group">
		    	<button class="btn" id="btnPedido" onclick="generatePedido()">Generar pedido</button>
		    </div>
	</div>
</body>
<script type="text/javascript">
	$.ajaxSetup({
      headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  	});

	function generatePedido(){
		if ($("#stock").val() == '') {
			alert('Por favor selecciona la Cantidad')
		} else {
			$.ajax({
		      	url:  "{{ route('pedido.save')}}",
		      	method: 'POST',
		      	data: {
		      		producto: $("#producto").val(),
		      		stock : $("#stock").val()
		      	},
		      	beforeSend: function(){
		        	console.log('enviando peticion')
		      	},
		      	success: function(res) {
		        console.log(res)
		        alert(res.msg)
		      	}
	    	});
		}

	}
</script>
