@extends('plantilla.admin')


@section('titulo', 'Administración de Categorías')


@section('contenido')



<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Sección de categorías</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 300px;">
                <a class=" m-2 float-right btn btn-primary"  href="{{ route('admin.category.create') }}">Crear</a>
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

                @foreach ($categorias as $categoria)
               
                    <tr>
                        <td> {{$categoria->id }} </td>
                        <td> {{$categoria->nombre }} </td>
                        <td> {{$categoria->slug }} </td>
                        <td> {{$categoria->descripcion }} </td>
                        <td> {{$categoria->created_at }} </td>
                        <td> {{$categoria->updated_at }} </td>

                        <td> <a class="btn btn-default"  
                            href="{{ route('admin.category.show',$categoria->slug) }}">Ver</a>
                        </td>

                        <td> <a class="btn btn-info" 
                            href="{{ route('admin.category.edit',$categoria->slug) }}">Editar</a>
                        </td>

                        <td> <a class="btn btn-danger" 
                            href="{{ route('admin.category.index') }}">Eliminar</a>
                        </td>
                        
                    </tr>
                @endforeach
             
              
            </tbody>
          </table>
          {{ $categorias->links() }}
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!-- /.row -->



 @endsection     