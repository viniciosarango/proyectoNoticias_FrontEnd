@extends('template')
@section('cuerpo')
    <div class="container">
        
        <div class="row">
            <div class="card-col-12">
                <div class="card-body">
                    <h5 class="card-title">Administrar Noticias</h5>                    
                    <div class="container">
                        <a href="{{$base_url}}index.php/admin/noticias/nuevo" class="btn btn-success col-3 mt-3">Nueva noticia</a>
                    </div>
                    <table class="table table-striped mt-4">
                        <thead class="thead-dark">
                            <tr>
                                <th>Numero</th>
                                <th>Titulo</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($noticias as $item)
                               <tr>
                                    <td>{{$loop -> iteration}}</td>
                                    <td>{{$item->titulo}}</td>
                                    <td>{{$item->fecha}}</td>
                                    <td><a href="{{$base_url}}index.php/admin/noticias/modificar/{{$item -> external}}" class="btn btn-info">Editar noticia</a></td>
                               </tr> 
                            @endforeach
                        </tbody>
                    </table>
                </div>    
            </div>    
        </div>
    </div>
@endsection