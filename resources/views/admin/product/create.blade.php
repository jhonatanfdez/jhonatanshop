@extends('plantilla.admin')


@section('titulo', 'Crear Producto')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{route('admin.product.index')}}">Productos</a></li>
  <li class="breadcrumb-item active">@yield('titulo')</li>
@endsection


@section('estilos')
  <!-- Select2 -->
 <link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
 <link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

@endsection

@section('scripts')
  
 <!-- Select2 -->
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>

<script src="/adminlte/ckeditor/ckeditor.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('#category_id').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
  });

</script> 

@endsection


@section('contenido')

 
<div id="apiproduct">




<form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" >
@csrf

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
                  <input  class="form-control" type="number" id="visitas" name="visitas">

                 
                </div>
                <!-- /.form-group -->
                
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">

                  <label>Ventas</label>
                  <input  class="form-control" type="number" id="ventas" name="ventas" >
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
                  <select name="category_id" id="category_id" class="form-control " style="width: 100%;">
                    @foreach($categorias as $categoria)
                    
                     @if ($loop->first)
                        <option value="{{ $categoria->id }}" selected="selected">{{ $categoria->nombre }}</option>
                     @else
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                     @endif
                    @endforeach


                  </select>
                  <label>Cantidad</label>
                  <input class="form-control" type="number" id="cantidad" name="cantidad" value="0">
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
                  <input 
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
                  <input
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
                  <input
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

                  <textarea class="form-control ckeditor" name="descripcion_corta" id="descripcion_corta" rows="3"></textarea>
                
                </div>
                <!-- /.form group -->

               <div class="form-group">
                  <label>Descripción larga:</label>

                  <textarea class="form-control ckeditor" name="descripcion_larga" id="descripcion_larga" rows="5"></textarea>
                
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

                  <textarea class="form-control ckeditor" name="especificaciones" id="especificaciones" rows="3"></textarea>
                
                </div>
                <!-- /.form group -->

               <div class="form-group">
                  <label>Datos de interes:</label>

                  <textarea class="form-control ckeditor" name="datos_de_interes" id="datos_de_interes" rows="5"></textarea>
                
                </div>                

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

       </div>
        <!-- /.col-md-6 -->



      </div>
      <!-- /.row -->




         <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Imágenes</h3>

           
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <div class="form-group">
                
               <label for="imagenes">Añadir imágenes</label> 
                              
               <input type="file" class="form-control-file" name="imagenes[]" id="imagenes[]" multiple 
               accept="image/*" >
               
               <div class="description">
                Un número ilimitado de archivos pueden ser cargados en este campo. 
                 <br>
                 Límite de 2048 MB por imagen.
                 <br>
                 Tipos permitidos: jpeg, png, jpg, gif, svg.
                 <br>
               </div>

            </div>


          </div>


          <!-- /.card-body -->
          <div class="card-footer">
            
          </div>
        </div>
        <!-- /.card -->


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
                  <select name="estado" id="estado" class="form-control " style="width: 100%;">
                    @foreach($estados_productos as $estado)
                    
                     @if ($estado == 'Nuevo')
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
                        <input type="checkbox" class="custom-control-input" id="activo" name="activo">
                        <label class="custom-control-label" for="activo">Activo</label>
                     </div>

                    </div>

                    <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox"  class="custom-control-input" id="sliderprincipal" name="sliderprincipal">
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
                   <input    
                   :disabled = "deshabilitar_boton==1"
                                 
                  type="submit" value="Guardar" class="btn btn-primary">
                 
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