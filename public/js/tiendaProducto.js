function carrito(){
    $.ajax({
        type: "GET",
        url: "carrito",
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

