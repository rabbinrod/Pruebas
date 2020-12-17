@extends('layout.general')

@section('content')
@if (session('error'))
<div>
    {{ session('error') }}
</div>
<br>
@endif
<form action="/agregar" method="post" enctype="multipart/form-data" >
    @csrf
    <div class="form-group">
        <label for="nombre">Nombre del usuario:</label>
        <input id="nombre" type="text" name="nombre" class="form-control">
    </div>
    <div class="form-group">
        <label for="a_paterno">Apellido paterno del usuario:</label>
        <input id="a_paterno" type="text" name="a_paterno" class="form-control">
    </div>
    <div class="form-group">
        <label for="a_materno">Apellido materno del usuario:</label>
        <input id="a_materno" type="text" name="a_materno" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">E-mail del usuario:</label>
        <input id="email" type="email" name="email" class="form-control">
        <small id="comp_mail"></small>
        <small id="result"></small>
    </div>
    <div class="form-group">
        <label for="imagen">Imagen del usuario:</label>
        <input type="file" name="imagen" id="imagen">
    </div>
    <div class="form-group">
        <label for="password">Password del usuario:</label>
        <input id="password" type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="password2">Repita el password:</label>
        <input id="password2" type="password" name="password2" class="form-control">
    </div>
    <input id="register" type="submit" class="btn btn-primary" value="Registrarse">    
</form>

<script>
    $('#email').blur(function(){
        var comp_mail='';
        var email= $('#email').val();
        var _token=$('input[name="_token"]').val();
        var filter= /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!filter.test(email))
        {
            $('#error').addClass('has-error');
            $('#comp_mail').html('<small class="text-danger">Correo Invalido</small>');
            $('#register').attr('disabled','disabled');
        }
        else
        {
            $.ajax({
               url:"{{route('verif')}}" ,
               method:"POST",
               data:{email:email, _token:_token},
               success:function(result)
               {
                   if(result=='unique')
                   {
                       $('#comp_mail').html('<label class="text-success">Email Disponible</label>');
                       $('#email').removeClass('has-error');
                       $('#register').attr('disabled',false);
                   }
                   else
                   {
                    $('#comp_mail').html('<small class="text-danger">Email en uso</small>');
                    $('#email').addClass('has-error');
                       $('#register').attr('disabled','disabled');
                   }
               }
            })
        }
    });
</script>
@endsection