$(function() {

    $('#submit-eliminar-producto-carrito').click(function(e){

        const formularioEliminarProductoCarrito = document.getElementById("form-eliminar-producto-carrito");
        

        const id_compra= document.getElementById("id_compra").value;
        
        

        formularioEliminarProductoCarrito.addEventListener("submit", (e)=>{
            e.preventDefault();
            console.log("GOLA")

            // var form_data = new FormData(document.getElementById("form-eliminar-producto-carrito"));
            //  function eliminarProductoEnCarrito(id_compra){
            Swal.fire({
                title: '¿Estas seguro?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, quitar de la lista.',
                cancelButtonText:'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: "eliminarProductoEnCarrito/"+id_compra,
                            // data: form_data,
                            // contentType:false,
                            // processData: false,
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                                console.log(data);
                
                                if(data.exito){
                                    Swal.fire({
                                        title: 'Exito',
                                        icon: 'success',
            
                                        text: data.exito,
                
                                    }).then(function(result) {
                                        location.reload();
                                    });
                                }        
                            },
                            error: function(error){
                                console.log(error);
                            }
                        });
                    }
                })
            //  }
            
        })

    });



    $('#submit-cerrar-boleta').click(function(e){
        const formularioCerrarBoleta = document.getElementById("form-cerrar-boleta");

        const numero_boleta= document.getElementById("numero_boleta").value;
        
        formularioCerrarBoleta.addEventListener("submit", (e)=>{
            e.preventDefault();
            console.log("HOLA")
            

            Swal.fire({
                title: '¿Desea realizar la compra?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText:'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "cerrarBoleta/"+numero_boleta,
                            // data: form_data,
                            // contentType:false,
                            // processData: false,
                            //dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                                console.log(data);

                                if(data.error){
                                    Swal.fire({
                                        title: 'Error',
                                        icon: 'info',
            
                                        text: data.error,
                
                                    }).then(function(result) {
                                        window.location.href = "productos";
                                    });
                                }        
                
                                if(data.exito){
                                    Swal.fire({
                                        title: 'Exito',
                                        icon: 'success',
            
                                        text: data.exito,
                
                                    }).then(function(result) {
                                        window.location.href = "productos";
                                    });
                                }        
                            },
                            error: function(error){
                                console.log(error);
                            }
                        });
                    }
                })

                // $.ajax({
                //     type: "POST",
                //     url: "cerrarBoleta/"+numero_boleta,
                //     //data: hola,
                //     // dataType: "json",
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     },
                //     success: function(data) {
                //         console.log(data);
        
                //         if(data.exito){
                //             Swal.fire({
                //                 title: 'Exito',
                //                 icon: 'success',

                //                 text: data.exito,
        
                //             }).then(function(result) {
                //                 //window.location.href = "productoSeleccionado/"+id_producto;
                //                 //location.reload();
                //                 window.location.href = "http://localhost/tienda/public/productos";
                //             });
                //         }        
                //     },
                //     error: function(error){
                //         console.log(error);
                //     }
                // });
        })
        

    });

});