<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<body style="background-color: gray; ">
  <h1 style="color: white;">Modulo de Productos</h1>
  <div class="container" style="background-color: whitesmoke;">
    <a href="{{ url('/') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
    <br>
    <br>
    <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#exampleModal">
      Registrar {{$title}}
    </button>
    <table class="table table-hover">
      <thead>
        <tr>
           <th>Cod</th>
           <th>Nombre</th>
           <th>Precio</th>
           <th>Categoria</th>
           <th>Opción</th>
       </tr>
      </thead>
      <tbody>
      @forelse ($productos as $producto)
        <tr>
              <td>{{$producto->id}}</td>
              <td>{{$producto->nombreproducto}}</td>
              <td>{{$producto->precio}}</td>
              <td>{{$producto->categoria}}</td>
              <td>
                <button class="btn btn-outline-danger" onclick="deleteProducto('{{$producto->id}}')">Eliminar</button>
                <button class="btn btn-outline-info" onclick="getProducto('{{$producto->id}}')" data-toggle="modal" data-target="#exampleModal2">Actualizar</button>
              </td>
            </tr>
      @empty
        <tr>
          <td><p>No hay {{$title}} registrados !.</p></td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registrar {{$title}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formProducto">
              <div class="form-group">
                  <strong>Nombre Producto:</strong>
                  <input type="text" name="nombreproducto"  id="nombreproducto" class="form-control" placeholder="Nombre Producto" required>
              </div>
              <div class="form-group">
                  <strong>Referencia:</strong>
                  <input type="text" name="referencia"  id="referencia" class="form-control" placeholder="Referencia">
              </div>
              <div class="form-group">
                  <strong>Categoria:</strong>
                  <input type="text" name="categoria"  id="categoria" class="form-control" placeholder="Categoria">
              </div>
              <div class="form-group">
                  <strong>Precio:</strong>
                  <input type="number" name="precio"  id="precio" class="form-control">
              </div>
              <div class="form-group">
                  <strong>Peso:</strong>
                  <input type="number" name="peso"  id="peso" class="form-control">
              </div>
               <div class="form-group">
                  <strong>Cantidad:</strong>
                  <input type="number" name="stock"  id="stock" class="form-control">
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="saveProducto()">Guardar {{$title}}</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modificar {{$title}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formProductoUpdate">
              <input type="hidden" name="idProducto" id="idProducto">
              <div class="form-group">
                  <strong>Nombre Producto:</strong>
                  <input type="text" name="nombreproductoUpdate"  id="nombreproductoUpdate" class="form-control" placeholder="Nombre Producto" required>
              </div>
              <div class="form-group">
                  <strong>Referencia:</strong>
                  <input type="text" name="referenciaUpdate"  id="referenciaUpdate" class="form-control" placeholder="Referencia">
              </div>
              <div class="form-group">
                  <strong>Categoria:</strong>
                  <input type="text" name="categoriaUpdate"  id="categoriaUpdate" class="form-control" placeholder="Categoria">
              </div>
              <div class="form-group">
                  <strong>Precio:</strong>
                  <input type="number" name="precioUpdate"  id="precioUpdate" class="form-control">
              </div>
              <div class="form-group">
                  <strong>Peso:</strong>
                  <input type="number" name="pesoUpdate"  id="pesoUpdate" class="form-control">
              </div>
               <div class="form-group">
                  <strong>Cantidad:</strong>
                  <input type="number" name="stockUpdate"  id="stockUpdate" class="form-control">
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="updateProducto()">Actualizar {{$title}}</button>
        </div>
      </div>
    </div>
  </div>  
</body>

<script type="text/javascript">
  $.ajaxSetup({
      headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  function saveProducto(){
    let data = $("#formProducto").serialize();
    $.ajax({
      url:  "{{ route('producto.save')}}",
      method: 'POST',
      data: data,
      beforeSend: function(){
        console.log('enviando peticion')
      },
      success: function(res) {
        location.reload();
        console.log('peticion') 
      }
    });
  }
  function getProducto(id){
    $.ajax({
                
                url:  "{{ route('producto.edit')}}",
                method: 'POST',
                data: {
                    'id': id
                },
                beforeSend: function(){
                    console.log('enviando peticion')
                },
                success: function(res) {
                  $("#idProducto").val(res.producto.id);
                  $("#nombreproductoUpdate").val(res.producto.nombreproducto);
                  $("#referenciaUpdate").val(res.producto.referencia);
                  $("#categoriaUpdate").val(res.producto.categoria);
                  $("#precioUpdate").val(parseInt(res.producto.precio));  
                  $("#pesoUpdate").val(res.producto.peso);
                  $("#stockUpdate").val(res.producto.stock);
                }
        });
  }
  function updateProducto(){
    let datatwo = $("#formProductoUpdate").serialize();
    console.log(JSON.stringify(datatwo))
    $.ajax({
                
                url:  "{{ route('producto.update')}}",
                method: 'POST',
                data: datatwo,
                beforeSend: function(){
                    console.log('enviando peticion actualizar')
                },
                success: function(res) {
                  location.reload();
                  console.log(res) 
                }
        });
  }
  function deleteProducto(id){
    $.ajax({
      url:  "{{ route('producto.delete')}}",
      method: 'POST',
      data: {
        'id': id
      },
      beforeSend: function(){
        console.log('enviando peticion')
      },
      success: function(res) {
        location.reload();  
        console.log('peticion') 
      }
    });
  }

</script>
