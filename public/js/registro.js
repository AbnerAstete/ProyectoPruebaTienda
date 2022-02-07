$(function() {

    $('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	
$('#login-submit').click(function(e){

	const formularioLogin = document.getElementById("login-form");

	const rutLogin = document.getElementById("rutLogin");
	const contrasenaLogin = document.getElementById("contrasenaLogin");

	const alertSuccessLogin = document.getElementById("alertSuccessLogin");
	const alertRutLogin = document.getElementById("alertRutLogin");
	const alertContrasenaLogin = document.getElementById("alertContrasenaLogin");

	const regRut= /^[0-9]+-[0-9kK]{1}$/; //solo permite numeros y guion - 10 digitos contando guion
	const regContrasena= /^[A-Za-z0-9]+$/g; //Solo numeros y letra

	// const mostrarMensajeExito = () => {
	// 	alertSuccessLogin.classList.remove('d-none');
	// 	alertSuccessLogin.textContent ="Ingresado"

	// }

	const mostrarMensajeError = (errores) => {
		errores.forEach((item) => {
			item.tipo.classList.remove("d-none");
			item.tipo.textContent = item.msg;
		});
	};


	formularioLogin.addEventListener("submit", (e)=>{
		e.preventDefault();
		alertSuccessLogin.classList.add("d-none");

		const errores = [];
		
		if(!regRut.test(rutLogin.value)){
			rutLogin.classList.add("is-invalid")
			errores.push({
				tipo: alertRutLogin,
				msg: "Ingrese un Rut válido."
			});
		}else{
			rutLogin.classList.remove("is-invalid")
			rutLogin.classList.add("is-valid")
			alertRutLogin.classList.add("d-none")
		}

		if(!regContrasena.test(contrasenaLogin.value) || !contrasenaLogin.value.trim()){
			contrasenaLogin.classList.add("is-invalid")
			errores.push({
				tipo: alertContrasenaLogin,
				msg: "Ingrese una contraseña válida."
			});
		}else{
			contrasenaLogin.classList.remove("is-invalid")
			contrasenaLogin.classList.add("is-valid")
			alertContrasenaLogin.classList.add("d-none")
		}

		if (errores.length !== 0) {
			mostrarMensajeError(errores);
			return;
		}
		
		console.log("Formulario enviado con exito");
		// mostrarMensajeExito();
		


		$.ajax({
			type: "POST",
			url: "ingresar",
			data: {rut: $('#rutLogin').val(),contrasena: $('#contrasenaLogin').val() },
			dataType: "json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				//"_token": $("meta[name='csrf-token']").attr("content")
			},
			success: function(data) {
				console.log(data);

				if(data.exito){
					window.location.href = "http://localhost/tienda/public/";
				}

				if(data.rutErroneo){
					Swal.fire({
						icon: 'info',
						title: 'Información',
						text: data.rutErroneo,
					  })
				}
				else if(data.ContrasenaErronea){
					Swal.fire({
						icon: 'info',
						title: 'Información',
						text: data.ContrasenaErronea,
					  })
				}
			},
			error: function(error){
				console.log(error);
			}
		});

	})

	

});

$('#register-submit').click(function(e){
	// console.log(e);
	// {{URL('/registrar')}}
	
	const formularioRegistro = document.getElementById("register-form");

	const rutRegistro = document.getElementById("rutRegistro");
	const nombreRegistro = document.getElementById("nombreRegistro");
	const apellidoRegistro = document.getElementById("apellidoRegistro");
	const correoRegistro = document.getElementById("correoRegistro");
	const contrasenaRegistro = document.getElementById("contrasenaRegistro");

	const alertSuccess = document.getElementById("alertSuccess");
	const alertRut = document.getElementById("alertRut");
	const alertNombre = document.getElementById("alertNombre");
	const alertaApellido = document.getElementById("alertApellido");
	const alertCorreo = document.getElementById("alertCorreo");
	const alertContrasena = document.getElementById("alertContrasena");

	const regUserName = /^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$/; //Solo letras
	const regUserEmail = /^[a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})$/;
	const regRut= /^([0-9]{8})+-[0-9k]{1}$/; //solo permite numeros y guion y K- 10 digitos contando guion
	const regContrasena= /^[A-Za-z0-9]+$/g; //numeros y letras


	const pintarMensajeError = (errores) => {
		errores.forEach((item) => {
			item.tipo.classList.remove("d-none");
			item.tipo.textContent = item.msg;
		});
	};
	
	formularioRegistro.addEventListener("submit", (e)=>{
		e.preventDefault();
		alertSuccess.classList.add("d-none");

		const errores = [];

		if(!regUserName.test(nombreRegistro.value) || !nombreRegistro.value.trim() ){
			nombreRegistro.classList.add("is-invalid")

			errores.push({
				tipo: alertNombre,
				msg: "Formato no valido, solo letras."
			});
		}else{
			nombreRegistro.classList.remove("is-invalid")
			nombreRegistro.classList.add("is-valid")
			alertNombre.classList.add("d-none")
		}

		if(!regUserName.test(apellidoRegistro.value) || !apellidoRegistro.value.trim() ){
			apellidoRegistro.classList.add("is-invalid")
			errores.push({
				tipo: alertaApellido,
				msg: "Formato no válido, solo letras."
			});
		}else{
			apellidoRegistro.classList.remove("is-invalid")
			apellidoRegistro.classList.add("is-valid")
			alertaApellido.classList.add("d-none")
		}
		
		if(!regUserEmail.test(correoRegistro.value)){
			correoRegistro.classList.add("is-invalid")
			errores.push({
				tipo: alertCorreo,
				msg: "Ingrese un correo válido."
			});
		}else{
			correoRegistro.classList.remove("is-invalid")
			correoRegistro.classList.add("is-valid")
			alertCorreo.classList.add("d-none")
		}

		if(!regRut.test(rutRegistro.value)){
			rutRegistro.classList.add("is-invalid")
			errores.push({
				tipo: alertRut,
				msg: "Ingrese un Rut válido."
			});
		}else{
			rutRegistro.classList.remove("is-invalid")
			rutRegistro.classList.add("is-valid")
			alertRut.classList.add("d-none")
		}

		if(!regContrasena.test(contrasenaRegistro.value) || !contrasenaRegistro.value.trim()){
			contrasenaRegistro.classList.add("is-invalid")
			errores.push({
				tipo: alertContrasena,
				msg: "Ingrese una contraseña válida."
			});
		}else{
			contrasenaRegistro.classList.remove("is-invalid")
			contrasenaRegistro.classList.add("is-valid")
			alertContrasena.classList.add("d-none")
		}

		if (errores.length !== 0) {
			pintarMensajeError(errores);
			return;
		}

		console.log("Formulario enviado con exito");
		mostrarMensajeExito();
	})
	

	$.ajax({
		type: "POST",
		url: "registrar",
		data: {rut:$('#rutRegistro').val(),nombre: $('#nombreRegistro').val(),apellido: $('#apellidoRegistro').val(),correo: $('#correoRegistro').val(),contrasena: $('#contrasenaRegistro').val() },
		dataType: "json",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		success: function(data) {

			console.log(data);

			if(data.exito){
				Swal.fire({
					icon: 'info',
					title: 'Usuario Registrado',
				}).then(function(result) {
					window.location.href = "registrar";

				});
			}

			if(data.error){
				var erroHtml = '<div class="alert alert-danger" style="text-align: left"><ul>';
            	var errores = data.error;

				errores.forEach(function(valor, id) {
					erroHtml += '<li>'+valor+'</li>';
				});                    
				erroHtml += '</ul></div>';               

				Swal.fire({
					title: 'Error',
					html: erroHtml
				});
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			console.log("error: ",textStatus);
		}
	});
 });

	
});
