
$(function() {


$('#productodisponible').DataTable({
        
        "ajax": {
            "destroy":true,
            "url": "productosDisponibles",
            "type": "get",
                },
            columns: [
                {data: 'nombre_producto', name: 'nombre_producto'},
                { data: 'talla_producto', name: 'talla_producto'},
                { data: 'precio_producto', name: 'precio_producto' },
                { data: 'stock_producto', name: 'stock_producto' },
                { data: 'descripcion', name: 'descripcion' },
                { data: 'imagen',name: 'imagen',
                    render: function(data, type,row){
                    var imagenes = "imagenes";
                     return '<center><img src=" '+imagenes+"/" +data+'" width="120" height="80" </center>';
                    },
                            },
                {data: 'categoria', name: 'categoria'},
                 {data: 'action', name: 'action' },
            ], 
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },   
        });

        
      


     
var productonodispo = $('#productonodisponible').DataTable({
        
        
        
        "ajax": {
            "url": "productosNoDisponibles",
            "type": "get",

                },
       columns: [
                {data: 'nombre_producto', name: 'nombre_producto'},
                { data: 'talla_producto', name: 'talla_producto'},
                { data: 'precio_producto', name: 'precio_producto' },
                { data: 'stock_producto', name: 'stock_producto' },
                { data: 'descripcion', name: 'descripcion' },
                { data: 'imagen',name: 'imagen',
                    render: function(data, type,row){
                        var imagenes = "imagenes";
                        return '<center><img src=" '+imagenes+"/" +data+'" width="120" height="80" </center>';
                      

                    },
                },
                
                {data: 'categoria', name: 'categoria'},
                {data: 'action', name: 'action' },
            ],   
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },     
                  
        });

$('#productoeliminado').DataTable({
        "ajax":{
                "url": "productosEliminados",
                "type": "get",
            },
         columns: [
            {data: 'nombre_producto', name: 'nombre_producto'},
            { data: 'talla_producto', name: 'talla_producto'},
            { data: 'precio_producto', name: 'precio_producto' },
            { data: 'stock_producto', name: 'stock_producto' },
            { data: 'descripcion', name: 'descripcion' },
                { data: 'imagen',name: 'imagen',
                    render: function(data, type,row){
                    var imagenes = "imagenes";
                     return '<center><img src=" '+imagenes+"/" +data+'" width="120" height="80" </center>';
                    },
                },

        ],
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
    });
   
});


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
                            $('#productonodisponible').DataTable().ajax.reload();
                            $('#productodisponible').DataTable().ajax.reload();
                            $('#productoeliminado').DataTable().ajax.reload();

                            // productonodispo.ajax.reload();

                            // window.location.href = "mostrarProducto";
                            
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


function habilitarProducto(id_producto){
    Swal.fire({
        title: 'Estas seguro?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
        }).then((result) => {
            if (result.isConfirmed) { 
            $.ajax({ 
                type: "GET",
                url: "habilitarProducto/"+ id_producto,
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
                            title: 'Producto habilitado correctamente',
    
                        }).then(function(result) {
                            $('#productonodisponible').DataTable().ajax.reload();
                            $('#productodisponible').DataTable().ajax.reload();
                            
                            // productonodispo.ajax.reload();

                            //  window.location.href = "mostrarProducto";
                            
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

function deshabilitarProducto(id_producto){
    Swal.fire({
        title: 'Estas seguro?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
        }).then((result) => {
            if (result.isConfirmed) { 



        $.ajax({ 
            type: "GET",
            url: "deshabilitarProducto/"+ id_producto,
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
                        title: 'Producto deshabilitado correctamente',

                    }).then(function(result) {
                        $('#productonodisponible').DataTable().ajax.reload();
                        $('#productodisponible').DataTable().ajax.reload();
                        
                        // productonodispo.ajax.reload();

                        //  window.location.href = "mostrarProducto";
                        
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



