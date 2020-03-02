@extends('plantilla.admin')


@section('titulo', 'Ver Producto')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{route('admin.product.index')}}">Productos</a></li>
  <li class="breadcrumb-item active">@yield('titulo')</li>
@endsection


@section('estilos')
  <!-- Select2 -->
 <link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
 <link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Ekko Lightbox -->
<link rel="stylesheet" href="/adminlte/plugins/ekko-lightbox/ekko-lightbox.css">
@endsection

@section('scripts')
  
 <!-- Select2 -->
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>

<script src="/adminlte/ckeditor/ckeditor.js"></script>

<!-- Ekko Lightbox -->
<script src="/adminlte/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>

<script>

  window.data = {
    
    editar:'Si',
    
    datos: {
      "nombre":"{{$producto->nombre}}",
      "precioanterior": "{{$producto->precio_anterior}}",
      "porcentajededescuento":"{{$producto->porcentaje_descuento}}"
    }
  }





  $(function () {
    //Initialize Select2 Elements
    $('#category_id').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });



    //uso de lightbox
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });








  });

</script> 

@endsection


@section('contenido')

 
<div id="apiproduct">




<form action="{{ route('admin.product.update',$producto->id) }}" method="POST" enctype="multipart/form-data" >
@csrf
@method('PUT')

  <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->



      <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Datos generados automáticamente</h3>

           
          </div>
          <!-- /.card-header -->
          <div class="card-body">

             <div class="row">
              <div class="col-md-6">
                <div class="form-group">

                  <label>Visitas</label>
                  <input  class="form-control" type="number" id="visitas" name="visitas"
                  readonly value="{{ $producto->visitas}}"
                    
                  >

                 
                </div>
                <!-- /.form-group -->
                
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">

                  <label>Ventas</label>
                  <input  class="form-control" type="number" id="ventas" name="ventas" 
                  readonly value="{{ $producto->ventas}}"
                  >
                </div>
                <!-- /.form-group -->
    
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->




          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            
          </div>
        </div>
        <!-- /.card -->



















        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Datos del producto</h3>

          
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">

                  <label>Nombre</label>
                  <input 
                  readonly
                   v-model="nombre"     
                   @blur="getProduct" 
                   @focus = "div_aparecer= false"
                  
                  class="form-control" type="text" id="nombre" name="nombre">

                  <label>Slug</label>
                  <input 
                  readonly 
                  v-model="generarSLug"  
                  
                  class="form-control" type="text" id="slug" name="slug" >

                  <div v-if="div_aparecer" v-bind:class="div_clase_slug">
                    @{{ div_mensajeslug }}
                 </div>
                 <br v-if="div_aparecer">
                 
                </div>
                <!-- /.form-group -->
                
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">




                  <label>Categoria</label>
                  <select disabled name="category_id" id="category_id" class="form-control " style="width: 100%;">
                    @foreach($categorias as $categoria)
                    
                     @if ($categoria->nombre == $producto->category->nombre)
                        <option value="{{ $categoria->id }}" selected="selected">{{ $categoria->nombre }}</option>
                     @else
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                     @endif
                    @endforeach


                  </select>
                  <label>Cantidad</label>
                  <input readonly class="form-control" type="number" id="cantidad" name="cantidad"
                  value="{{ $producto->cantidad}}"
                   >
                </div>
                <!-- /.form-group -->
    
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->


          </div>
          <!-- /.card-body -->
          <div class="card-footer">
           
        </div>
      </div>

        <!-- /.card -->



        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Sección de Precios</h3>

            
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">



              <div class="col-md-3">
                <div class="form-group">

                  <label>Precio anterior</label>
                  


                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input readonly 
                  v-model="precioanterior" 
                  class="form-control" type="number" id="precioanterior" name="precioanterior" min="0" value="0" step=".01">                 
                </div>
                 
                </div>
                <!-- /.form-group -->
                
              </div>
              <!-- /.col -->



              <div class="col-md-3">
                <div class="form-group">

                  <label>Precio actual</label>
                   <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input readonly
                  v-model="precioactual" 
                  
                  class="form-control" type="number" id="precioactual" name="precioactual" min="0" value="0" step=".01">                 
                </div>

                <br>
                <span id="descuento">

                  @{{ generardescuento }}

                </span>
                </div>
                <!-- /.form-group -->
    
              </div>
              <!-- /.col -->




              <div class="col-md-6">
                <div class="form-group">

                  <label>Porcentaje de descuento</label>
                   <div class="input-group">                  
                  <input readonly
                  v-model="porcentajededescuento" 
                  class="form-control" type="number" id="porcentajededescuento" name="porcentajededescuento" step="any" min="0" max="100" value="0" >    <div class="input-group-prepend">
                    <span class="input-group-text">%</span>
                  </div>  

                </div>

                <br>
                <div class="progress">
                    <div id="barraprogreso" class="progress-bar" role="progressbar"                           
                    v-bind:style="{width: porcentajededescuento+'%'}"

                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">@{{ porcentajededescuento }}%</div>
                </div>
                </div>
                <!-- /.form-group -->
                
              </div>
              <!-- /.col -->


            </div>
            <!-- /.row -->


          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            
          </div>
        </div>
        <!-- /.card -->







   <div class="row">
          <div class="col-md-6">

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Descripciones del producto</h3>
              </div>
              <div class="card-body">
                <!-- Date dd/mm/yyyy -->
                <div class="form-group">
                  <label>Descripción corta:</label>

                  <textarea readonly class="form-control ckeditor" name="descripcion_corta" id="descripcion_corta" rows="3">
                    {!! $producto->descripcion_corta !!}
                    
                  </textarea>
                
                </div>
                <!-- /.form group -->

               <div class="form-group">
                  <label>Descripción larga:</label>

                  <textarea readonly class="form-control ckeditor" name="descripcion_larga" id="descripcion_larga" rows="5">
                    {!! $producto->descripcion_larga !!}

                  </textarea>
                
                </div>                

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

       </div>
        <!-- /.col-md-6 -->




          <div class="col-md-6">

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Especificaciones y otros datos</h3>
              </div>
              <div class="card-body">
                <!-- Date dd/mm/yyyy -->
                <div class="form-group">
                  <label>Especificaciones:</label>

                  <textarea readonly class="form-control ckeditor" name="especificaciones" id="especificaciones" rows="3">
                    {!! $producto->especificaciones !!}
                    
                  </textarea>
                
                </div>
                <!-- /.form group -->

               <div class="form-group">
                  <label>Datos de interes:</label>

                  <textarea readonly class="form-control ckeditor" name="datos_de_interes" id="datos_de_interes" rows="5">
                    {!! $producto->datos_de_interes !!}
                  </textarea>
                
                </div>                

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

       </div>
        <!-- /.col-md-6 -->



      </div>
      <!-- /.row -->










      




        <div class="card card-primary">
          <div class="card-header">
            <div class="card-title">
             Galeria de imagenes
            </div>
          </div>
          <div class="card-body">
            <div class="row">

              @foreach ($producto->images as $image)
              <div id="idimagen-{{$image->id}}" class="col-sm-2">
                <a href="{{ $image->url }}" data-toggle="lightbox" data-title="Id:{{ $image->id }}"  data-gallery="gallery">
                  <img style="width:150px; height:150px;" src="{{ $image->url }}" class="img-fluid mb-2" />
                </a>
                <br>
                <a style="display:none" href="{{ $image->url }}"
                    v-on:click.prevent="eliminarimagen({{$image}})"
                  
                  >
                  <i class="fas fa-trash-alt" style="color:red"></i> Id:{{ $image->id }}
                </a>
              </div>
              
              
              @endforeach
             

              
              
            </div>
          </div>
        </div>















      <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Administración</h3>
          </div>
          <!-- /.card-header -->
      <div class="card-body">

       <div class="row">
              <div class="col-md-6">
                <div class="form-group">


                  
                  <label>Estado</label>
                  <select disabled name="estado" id="estado" class="form-control " style="width: 100%;">
                    @foreach($estados_productos as $estado)
                    
                     @if ($estado == $producto->estado)
                        <option value="{{ $estado }}" selected="selected">{{ $estado }}</option>
                     @else
                        <option value="{{ $estado }}">{{ $estado }}</option>
                     @endif
                    @endforeach
                  </select>






                 
                </div>
                <!-- /.form-group -->
                
              </div>
              <!-- /.col -->
              <div class="col-sm-6">
                    <!-- checkbox -->
                    <div class="form-group clearfix">
                      <div class="custom-control custom-checkbox">
                        <input disabled type="checkbox" class="custom-control-input" id="activo" name="activo"   
                        
                            @if($producto->activo=='Si')
                                checked
                            @endif
                        
                        >
                        <label class="custom-control-label" for="activo">Activo</label>
                     </div>

                    </div>

                    <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input  disabled type="checkbox"  class="custom-control-input" id="sliderprincipal" name="sliderprincipal" 
                        @if($producto->sliderprincipal=='Si')
                            checked
                        @endif
                      >
                      <label class="custom-control-label" for="sliderprincipal">Aparece en el Slider principal</label>
                    </div>
                  </div>

                  </div>

                

       </div>
            <!-- /.row -->




       <div class="row">
              <div class="col-md-12">
                <div class="form-group">

                   <a class="btn btn-danger" href="{{ route('cancelar','admin.product.index') }}">Cancelar</a>
                   
                   <a class="btn btn-outline-success" href="{{ route('admin.product.edit',$producto->slug) }}">Editar</a>
                 
                </div>
                <!-- /.form-group -->
                
              </div>
              <!-- /.col -->


           
                

       </div>
            <!-- /.row -->




          </div>


   
          <!-- /.card-body -->
          <div class="card-footer">
            
          </div>
        </div>
        <!-- /.card -->






      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->



    </form>
  </div>

 @endsection