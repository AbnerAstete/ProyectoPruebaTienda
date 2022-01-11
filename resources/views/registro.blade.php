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
								<form id="login-form" action="{{URL('/ingresar')}}" method="post" role="form" autocomplete="off" style="display: block;">
									{{csrf_field()}}

									@foreach ($errors->get('rut') as $error)
                						<div class="alert alert-danger">
                 							 El rut es requerido
                						</div>
									@endforeach

									@foreach ($errors->get('contrasena') as $error)
                						<div class="alert alert-danger">
                 							 La contraseña es requerida
                						</div>
									@endforeach

									{{-- @if (session('error'))
									<div class="alert alert-danger">
										{{session('error')}}
									</div>	
									@endif	 --}}

									
									<div class="form-group">
										<input type="text" name="rut" id="rut" tabindex="1" class="form-control" placeholder="Ingrese Rut con guion" value="">
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
								<form id="register-form" action="{{URL('/registrar')}}"  method="post" role="form" style="display: none;" autocomplete="off">
									{{csrf_field()}}

									@if (count($errors)> 0)
										@foreach ($errors->all() as $error)
											<p class="alert alert-danger">
												{{$error}}
											</p> 																			
										@endforeach
									@endif

									{{-- @foreach ($errors->get('rut') as $error)
                						<div class="alert alert-danger">
                 							 El rut es requerido
                						</div>
									@endforeach

									@foreach ($errors->get('nombre') as $error)
                						<div class="alert alert-danger">
                 							 El nombre es requerido
                						</div>
									@endforeach

									@foreach ($errors->get('apellido') as $error)
                						<div class="alert alert-danger">
                 							 El apellido es requerido
                						</div>
									@endforeach
									@foreach ($errors->get('correo') as $error)
                						<div class="alert alert-danger">
                 							 El correo es requerido
                						</div>
									@endforeach
									
									@foreach ($errors->get('contrasena') as $error)
										<div class="alert alert-danger">
											La contraseña es requerida
										</div>
									@endforeach --}}

									
									<div class="form-group">
										<input type="text" name="rut" id="rut" tabindex="1" class="form-control" placeholder=" Ingrese Rut con guion" value="">
									</div>
									<div class="form-group">
										<input type="text" name="nombre" id="nombre" tabindex="1" class="form-control" placeholder="Ingrese Nombre" value="">
									</div>
									<div class="form-group">
										<input type="text" name="apellido" id="apellido" tabindex="1" class="form-control" placeholder="Ingrese Apellido" value="">
									</div>
									<div class="form-group">
										<input type="email" name="correo" id="correo" tabindex="1" class="form-control" placeholder="Email: example@email.com " value="">
									</div>
									<div class="form-group">
										<input type="password" name="contrasena" id="contrasena" tabindex="2" class="form-control" placeholder="Ingrese Contraseña">
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