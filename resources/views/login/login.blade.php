<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Car Wash De Carlos De la Cruz</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('public/styles.css')}}"> 
  <link rel="stylesheet" href="{{asset('public/fontawesome-free/cssall.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <p>Car Wash El Washer</p>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      @if($errors->any())
      <div class="alert alert-danger" role="alert">
        {{$errors->first()}}
      </div>
     @endif
      <form  action="{{action('Auth\LoginController@login')}}" method="POST">
        {{csrf_field()}}
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
          <button type="submit" class="btn btn-success btn-block">Ingresar</button>
          <a href="/car_wash/register_for_user" class="text-center btn btn-info btn-block">Registrarte</a>        
      </form>
  </div>
</div>
</body>
</html>
