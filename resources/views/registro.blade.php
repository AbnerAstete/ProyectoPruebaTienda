@extends('plantilla')

@section('seccion')


<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
{{-- <meta name="csrf-token" content="{{ csrf_token() }}">| --}}
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<link rel="stylesheet" href="{{asset('css/registro.css') }}">
<script type="text/javascript" src="{{asset('js/registro.js') }}"> </script>
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
									
								<form id="login-form" method="post" role="form" autocomplete="off" style="display: block;">
									{{csrf_field()}}
									
									<div class="form-group">
										<input type="text" name="rut" id="rutLogin" tabindex="1" class="form-control" placeholder="Ingrese Rut con guion" value="">
									</div>
									<p class="text-danger mb-2 d-none" id="alertRutLogin"></p>
									<div class="form-group">
										<input type="password" name="contrasena" id="contrasenaLogin" tabindex="2" class="form-control" placeholder="Contraseña">
									</div>
									<p class="text-danger mb-2 d-none" id="alertContrasenaLogin"></p>
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
									<div class="alert alert-success mt-2 d-none" id="alertSuccessLogin"></div>
								</form>
								

								<form id="register-form"  method="post" role="form" style="display: none;" autocomplete="off">
									{{csrf_field()}}

									<div class="form-group">
										<input type="text" name="rut" id="rutRegistro" tabindex="1" class="form-control" placeholder=" Ingrese Rut con guion" value="">
									</div>
									<p class="text-danger mb-2 d-none" id="alertRut"></p>
									<div class="form-group">
										<input type="text" name="nombre" id="nombreRegistro" tabindex="1" class="form-control" placeholder="Ingrese Nombre" value="">
									</div>
									<p class="text-danger mb-2 d-none" id="alertNombre"></p>
									<div class="form-group">
										<input type="text" name="apellido" id="apellidoRegistro" tabindex="1" class="form-control" placeholder="Ingrese Apellido" value="">
									</div>
									<p class="text-danger mb-2 d-none" id="alertApellido"></p>
									<div class="form-group">
										<input type="email" name="correo" id="correoRegistro" tabindex="1" class="form-control" placeholder="Email: example@email.com " value="">
									</div>
									<p class="text-danger mb-2 d-none" id="alertCorreo"></p>
									<div class="form-group">
										<input type="password" name="contrasena" id="contrasenaRegistro" tabindex="2" class="form-control" placeholder="Ingrese Contraseña">
									</div>
									<p class="text-danger mb-2 d-none" id="alertContrasena"></p>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input  type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registrarse">
											</div>
										</div>
									</div>
									<div class="alert alert-success mt-2 d-none" id="alertSuccess"></div>
								</form>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>        
@endsection
