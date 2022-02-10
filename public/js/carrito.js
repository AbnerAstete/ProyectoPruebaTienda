$(function() {

    $('#submit-cerrar-boleta').click(function(e){
        const formularioCerrarBoleta = document.getElementById("form-cerrar-boleta");

        const numero_boleta= document.getElementById("numero_boleta").value;
        
        formularioCerrarBoleta.addEventListener("submit", (e)=>{
            e.preventDefault();
            

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
                                        icon: 'error',
            
                                        text: data.error,
                
                                    }).then(function(result) {
                                        window.location.href = "productos";
                                    });
                                } 

                                if(data.errorCantidad){
                                    Swal.fire({
                                        title: 'Error',
                                        icon: 'error',
            
                                        text: data.errorCantidad,
                
                                    }).then(function(result) {
                                        location.reload();
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
        })
    });
});


function eliminar(id_compra){
    Swal.fire({
        title: '¿Desea quitar este producto?',
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
                url: "eliminarProductoEnCarrito/"+id_compra,
                //data: {cantidad_productos: $('#cantidadProducto').val(),id_producto: $('#id_producto').val()},
                // dataType: "json",
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

}