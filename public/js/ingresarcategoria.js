$(function() {

    
    $('#categoria-submit').click(function(e){
        console.log("asasd");

            const formulario = document.getElementById('formulario_categoria');
            const nombre_categoria = document.getElementById('nombre_categoria');

            const alertSuccess = document.getElementById('alertSuccess');
            const alert_nombre_categoria = document.getElementById('alert_nombre_categoria');

            const reg_nombre_categoria=/^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$/;
            
            
            const MensajeExito = () =>{
                alertSuccess.classList.remove('d-none')
                alertSuccess.textContent= "Mensaje enviado con exito"
            }
            const MensajeError = (errores) =>{
                errores.forEach(item =>{
                    item.tipo.classList.remove("d-none")
                    item.tipo.textContent = item.msg

                })
            }
            formulario.addEventListener('submit', (e) => {
                console.log(this);

                e.preventDefault();
                alertSuccess.classList.add('d-none');

                const errores =[];
             

                console.log(nombre_categoria.value);
                

                
                if(!reg_nombre_categoria.test(nombre_categoria.value)||  !nombre_categoria.value.trim()) {
                    nombre_categoria.classList.add("is-invalid");

                    errores.push({
                        tipo: alert_nombre_categoria,
                        msg: "Formato no valido para el nombre de la categoria (solo letras)"
                    });
                }else{
                    nombre_categoria.classList.remove("is-invalid");
                    nombre_categoria.classList.add("is-valid");
                    alert_nombre_categoria.classList.add("d-none");

                }
                if  ((nombre_categoria.value) === null) {
                    return 'asdasdsad';
                }

              
            

                if(errores.length !== 0){
                    MensajeError(errores)
                    return
                }
                console.log('formulario enviado');
                MensajeExito();

            });
            
            //console.log($('#formulario_producto')[0]);
            //var fd = new FormData(this);    
            
            var form_data = new FormData(document.getElementById("formulario_categoria"));
            $.ajax({ //AJAX
                type: "POST",
                url: "agregarCategorias",
                data: form_data,
                contentType:false,
                processData: false,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log(data);
    
                    if(data.exito){
                        Swal.fire({
                            title: 'Categoria ingresada correctamente',
                        }).then(function(result) {
                            window.location.href = "mostrarCategorias";
                            
                        });
                        
                    }
    
                    if(data.errores){

                        var erroHtml = '<div class="alert alert-danger" style="text-align: left"><ul>';
                        var errores = data.errores;
        
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
                error: function(error){
                    console.log(error);
                }
            });



    });
    
    





});