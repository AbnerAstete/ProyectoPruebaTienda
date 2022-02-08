$(function() {

    $('#cantidadSeleccionada-submit').click(function(e){

        const formularioCantidadSeleccionada = document.getElementById("cantidadSeleccionada");
        const cantidadProducto = document.getElementById("cantidadProducto");

        const alertCantidad = document.getElementById("alertCantidad");
        const alertSuccess = document.getElementById("alertSuccess");

        // const RegCantidad = '{{$producto->stock_producto}}';

        // const mostrarMensajeError = (errores) => {
        //     errores.forEach((item) => {
        //         item.tipo.classList.remove("d-none");
        //         item.tipo.textContent = item.msg;
        //     });
        // };

        formularioCantidadSeleccionada.addEventListener("submit", (e)=>{
            e.preventDefault();
		    // alertSuccess.classList.add("d-none");

            // const errores = [];

            // if(!RegCantidad.test(cantidadProducto.value)){
            //     cantidadProducto.classList.add("is-invalid")
            //     errores.push({
            //         tipo: alertCantidad,
            //         msg: "Ingrese una cantidad valida."
            //     });
            // }else{
            //     cantidadProducto.classList.remove("is-invalid");
            //     cantidadProducto.classList.add("is-valid");
            //     alertCantidad.classList.add("d-none");
            // }
    
            // if (errores.length !== 0) {
            //     mostrarMensajeError(errores);
            //     return;
            // }
    
            // console.log("Formulario enviado con exito");
    
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
                            //window.location.href = "productoSeleccionado/"+id_producto;
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
                // Swal.fire({
                //     title: 'Dirigiendo a carrito',
                //     icon: 'success',

                //     text: data.exito,

                // }).then(function(result) {
                //     //window.location.href = "productoSeleccionado/"+id_producto;
                //     //location.reload();
                //     window.location.href = "http://localhost/tienda/public/carrito";
                // });
                window.location.href = "http://localhost/tienda/public/carrito";
            }        
        },
        error: function(error){
            console.log(error);
        }
    });
}