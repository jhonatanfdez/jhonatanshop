@extends('plantilla.admin')


@section('titulo', 'Administración de productos')

@section('breadcrumb')
  <li class="breadcrumb-item active">@yield('titulo')</li>
@endsection


@section('contenido')



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
        <div class="card-body table-responsive p-0" style="height: 300px;">
                <a class=" m-2 float-right btn btn-primary"  href="{{ route('admin.product.create') }}">Crear</a>
          <table class="table table-head-fixed">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Slug</th>
                <th>Descripción</th>
                <th>Fecha creación</th>
                <th>Fecha modificación</th>
                <th colspan="3"></th>
              </tr>
            </thead>
            <tbody>

                @foreach ($productos as $producto)
               
                    <tr>
                        <td> {{$producto->id }} </td>
                        <td> {{$producto->nombre }} </td>
                        <td> {{$producto->slug }} </td>
                        <td> {{$producto->descripcion }} </td>
                        <td> {{$producto->created_at }} </td>
                        <td> {{$producto->updated_at }} </td>

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