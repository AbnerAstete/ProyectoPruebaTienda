@extends('plantilla')

@section('seccion')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link rel="stylesheet" href="{{asset('css/style.css') }}">

<script type="text/javascript" src="{{asset('js/script.js') }}"> </script>
<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Registro</a>
                                
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form"  method="post" role="form" style="display: block;">
									
									<div class="form-group">
										<input type="text" name="nombre" id="nombre" tabindex="1" class="form-control" placeholder="Nombre" value="">
									</div>
									<div class="form-group">
										<input type="password" name="contrasena" id="contrasena" tabindex="2" class="form-control" placeholder="Contraseña">
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember">Recordar Contraseña</label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Ingresar">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="https://phpoll.com/recover" tabindex="5" class="forgot-password">¿Olvidaste tu contraseña?</a>
												</div>
											</div>
										</div>
									</div>
								</form>
								<form id="register-form" action="{{URL('/registrar')}}"  method="post" role="form" style="display: none;" >
									{{csrf_field()}}
									<div class="form-group">
										<input type="text" name="rut" id="rut" tabindex="1" class="form-control" placeholder="Rut" value="">
									</div>
									<div class="form-group">
										<input type="text" name="nombre" id="nombre" tabindex="1" class="form-control" placeholder="Nombre" value="">
									</div>
									<div class="form-group">
										<input type="text" name="apellido" id="apellido" tabindex="1" class="form-control" placeholder="Apellido" value="">
									</div>
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email " value="">
									</div>
									<div class="form-group">
										<input type="password" name="contrasena" id="contrasena" tabindex="2" class="form-control" placeholder="Contraseña">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input  type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registrarse">
											 
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>        

@endsection
