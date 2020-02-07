@extends('plantilla.admin')


@section('titulo', 'Administración de productos')

@section('breadcrumb')
  <li class="breadcrumb-item active">@yield('titulo')</li>
@endsection


@section('contenido')
<style type="text/css">
  .table1 {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
    text-align: center;
  }

  .table1 td, .table1 th {
    padding: .75rem;
    vertical-align: center;
    border-top: 1px solid #dee2e6;
  }

</style>  


<div id="confirmareliminar" class="row">

  <span style="display:none;" id="urlbase">{{route('admin.product.index')}}</span>
  @include('custom.modal_eliminar')
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Sección de productos</h3>

          <div class="card-tools">
            
            <form>              
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="nombre" class="form-control float-right" 
                placeholder="Buscar"
                value="{{ request()->get('nombre') }}"
                >

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
              </div>
            </form>

          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" >
                <a class=" m-2 float-right btn btn-primary"  href="{{ route('admin.product.create') }}">Crear</a>
          <table class="table1 table-head-fixed">
            <thead>
              <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Activo</th>
                <th>Slider Principal</th>
                <th colspan="3"></th>
              </tr>
            </thead>
            <tbody>

                @foreach ($productos as $producto)
                    <tr>
                        <td> {{$producto->id }} </td>
                        <td>  
                           @if ($producto->images->count()<=0 )
                              <img style="height: 100px;    width: 100px;" src="/imagenes/avatar.png" class="rounded-circle">
                           @else
                              <img style="height: 100px;    width: 100px;" src="{{ $producto->images->random()->url }}" class="rounded-circle">   
                           @endif

                          


                        </td>
                        <td> {{$producto->nombre }} </td>
                        <td> {{$producto->estado }} </td>
                        <td> {{$producto->activo }} </td>
                        <td> {{$producto->sliderprincipal }} </td>

                        <td> <a class="btn btn-default"  
                            href="{{ route('admin.product.show',$producto->slug) }}">Ver</a>
                        </td>

                        <td> <a class="btn btn-info" 
                            href="{{ route('admin.product.edit',$producto->slug) }}">Editar</a>
                        </td>

                        <td> <a class="btn btn-danger" 
                            href="{{ route('admin.product.index') }}" 
                            v-on:click.prevent="deseas_eliminar({{$producto->id}})"
                            >Eliminar</a>
                        </td>
                        
                    </tr>
                @endforeach
             
              
            </tbody>
          </table>
          {{ $productos->appends($_GET)->links() }}
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!-- /.row -->



 @endsection     