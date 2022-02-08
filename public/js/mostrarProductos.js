

    function eliminarProducto(id_productox){
        console.log(id_productox)


        Swal.fire({
            title: 'Estas seguro?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si,borrar '
            }).then((result) => {
                if (result.isConfirmed) { 
                $.ajax({ 
                    type: "GET",
                    url: "eliminarProducto/"+id_productox,
                    // data: {id_productox : id_productox},
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
                                title: 'Exito',
                                icon: 'success',

                                text: data.exito,
        
                            }).then(function(result) {
                                window.location.href = "mostrarProducto";
                                
                            });
                            
                        }
                        if(data.error){
                            Swal.fire({
                                title: 'Ha ocurrido un error',
                                
                            }).then(function(result) {
                                window.location.href = "mostrarProducto";
                                
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





