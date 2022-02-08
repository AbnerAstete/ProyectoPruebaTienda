$(function() {

    
    $('#producto-submit').click(function(e){


            const formulario = document.getElementById('formulario_producto');
            const nombre_producto = document.getElementById('nombre_producto');
            const talla_producto = document.getElementById('talla_producto');
            const precio_producto = document.getElementById('precio_producto');
            const disponibilidad_producto = document.getElementById('disponibilidad_producto');
            const stock_producto = document.getElementById('stock_producto');
            const descripcion_producto = document.getElementById('descripcion_producto');
            const ruta = document.getElementById('ruta');

            const alertSuccess = document.getElementById('alertSuccess');
            const alert_nombre_producto = document.getElementById('alert_nombre_producto');
            const alert_precio_producto = document.getElementById('alert_precio_producto');
            const alert_stock_producto = document.getElementById('alert_stock_producto');
            const alert_descripcion_producto = document.getElementById('alert_descripcion_producto');

            const reg_nombre_producto=/^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$/;
            const reg_precio_producto=/^[0-9]*(\.?)[0-9]+$/;
            const reg_stock_producto=/^[0-9]*(\.?)[0-9]+$/;
            const reg_descripcion_producto=/^[A-Za-z0-9\s]+$/g
            ;
            
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
             

                console.log(nombre_producto.value);
                console.log(precio_producto.value);
                console.log(stock_producto.value);
                console.log(descripcion_producto.value);
                

                
                if(!reg_nombre_producto.test(nombre_producto.value)||  !nombre_producto.value.trim()) {
                    nombre_producto.classList.add("is-invalid");

                    errores.push({
                        tipo: alert_nombre_producto,
                        msg: "Formato no valido para el nombre del producto (solo letras)"
                    });
                }else{
                    nombre_producto.classList.remove("is-invalid");
                    nombre_producto.classList.add("is-valid");
                    alert_nombre_producto.classList.add("d-none");

                }
                if  ((nombre_producto.value) === null) {
                    return 'ola';
                }

                if(!reg_precio_producto.test(precio_producto.value)|| !precio_producto.value.trim()){
                    precio_producto.classList.add("is-invalid");

                    errores.push({
                        tipo: alert_precio_producto,
                        msg: "Formato no valido para el precio del producto (solo numeros)"
                    });
                }else{
                    precio_producto.classList.remove("is-invalid");
                    precio_producto.classList.add("is-valid");
                    alert_precio_producto.classList.add("d-none");
                }
                if(!reg_stock_producto.test(stock_producto.value)|| !stock_producto.value.trim()){
                    stock_producto.classList.add("is-invalid");

                    errores.push({
                        tipo: alert_stock_producto,
                        msg: "Formato no valido para el stock del producto (solo numeros)"
                    });
                }else{
                    stock_producto.classList.remove("is-invalid");
                    stock_producto.classList.add("is-valid");
                    alert_stock_producto.classList.add("d-none");
                }
                if(!reg_descripcion_producto.test(descripcion_producto.value)|| !descripcion_producto.value.trim()){
                    descripcion_producto.classList.add("is-invalid");

                    errores.push({
                        tipo: alert_descripcion_producto,
                        msg: "Formato no valido para la descripcion del producto (solo letras)"
                    });
                }else{
                    descripcion_producto.classList.remove("is-invalid");
                    descripcion_producto.classList.add("is-valid");
                    alert_descripcion_producto.classList.add("d-none");
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
            
            var form_data = new FormData(document.getElementById("formulario_producto"));
            $.ajax({ //AJAX
                type: "POST",
                url: "agregarProducto",
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
                            title: 'Producto ingresado correctamente',
                        }).then(function(result) {
                            window.location.href = "mostrarProducto";
                            
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