$(function() {

    $('#cantidadSeleccionada-submit').click(function(e){

        const formularioCantidadSeleccionada = document.getElementById("cantidadSeleccionada");
        const cantidadProducto = document.getElementById("cantidadProducto");

        const alertCantidad = document.getElementById("alertCantidad");
        const alertSuccess = document.getElementById("alertSuccess");

        formularioCantidadSeleccionada.addEventListener("submit", (e)=>{
            e.preventDefault();
    
            $.ajax({
                type: "POST",
                url: "../agregarAlCarrito",
                data: {cantidad_productos: $('#cantidadProducto').val(),id_producto: $('#id_producto').val()},
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
        
        })

    });

});

function carrito(){
    $.ajax({
        type: "GET",
        url: "../carrito",
        //data: {cantidad_productos: $('#cantidadProducto').val(),id_producto: $('#id_producto').val()},
        // dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            console.log(data);

            if(data.error){
                Swal.fire({
                    title: 'No fue posible',
                    icon: 'error',

                    text: data.error,

                });
            }
            else{
                window.location.href = "http://localhost/tienda/public/carrito";
            }        
        },
        error: function(error){
            console.log(error);
        }
    });
}