@extends('template')
@section('cuerpo')
    <div class="container">
        <div class="card mt-2">
            <h5 class="card-header">Registro de noticias</h5>
            <div class="card-body">
                <form method="post" action="{{$base_url}}index.php/admin/noticias/save">
                <div class="input-group form-group mt-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" name="titulo" class="form-control" placeholder="Titulo" required>
                    
                </div>
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <textarea type="text" name="cuerpo" class="form-control" placeholder="Cuerpo" required></textarea>
                </div>
                
                <div class="form-group">
                    <input type="submit" value="Guardar" class="btn btn-success col-3 mt-3">
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection