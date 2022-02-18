<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boleta</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap4.min.css')}}">
    
</head>
<body>
    <h1>Loop</h1>
        
            <div style="font-weight: bold;">Numero Boleta: {{$boleta->numero_boleta}}</div>
            <div style="font-weight: bold;">Datos Cliente: </div>
            <br>


            <div class="card" style="width: 55rem;height:5rem">
                <div class="card-body">
                    <div class="row">                   
                        <div class="col-md-3" style="float: left;padding: 0px !important;width: 25%;"> Nombre: {{$usuario->nombre}} {{$usuario->apellido}} </div>
                        <div class="col-md-3" style="float: left;padding: 0px !important;width: 25%;"> Rut: {{$usuario->rut}}  </div>
                        <div class="col-md-3" style="float: left;padding: 0px !important;width: 25%;"> Correo: {{$usuario->correo}}  </div>
                        <div class="col-md-3" style="float: left;padding: 0px !important;width: 25%;"> Telefonos: Sin Informacion</div>         
                    </div> 
                </div>
            </div>

            {{-- <div class="container">
                <div class="row">                   
                    <div class="col-md-3" style="float: left;padding: 0px !important;width: 25%;"> Nombre: {{$usuario->nombre}} {{$usuario->apellido}} </div>
                    <div class="col-md-3" style="float: left;padding: 0px !important;width: 25%;"> Rut: {{$usuario->rut}}  </div>
                    <div class="col-md-3" style="float: left;padding: 0px !important;width: 25%;"> Correo: {{$usuario->correo}}  </div>
                    <div class="col-md-3" style="float: left;padding: 0px !important;width: 25%;"> Telefonos: Sin Informacion</div>         
                </div> 
            </div>  --}}
              
            <br>
            <br>
            <br>
            <div style="font-weight: bold;">Detalles Compra: </div>

                <table class="table" style="text-align: center; border-spacing: 60px 10px;">
                    <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Iva</th>
                        <th scope="col">Descuentos</th>
                        <th scope="col">Descripcion del Producto</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($compras as $productos)
                    <tr>
                        <td scope="row">{{ $productos->nombre_producto}}</td>
                        <td>{{ $productos->cantidad_productos }}</td>
                        <td>$ {{$productos->precio_producto*$productos->cantidad_productos}}</td>
                        <td>$ {{(($productos->precio_producto*$productos->cantidad_productos)*1.19)-$productos->precio_producto*$productos->cantidad_productos}}</td>
                        <td>$ 0.00</td>
                        <td>{{$productos->descripcion}}</td>
                    </tr>
                    <div id="elemento" style="visibility:hidden;">{{$valorTotal += ($productos->precio_producto * $productos->cantidad_productos)}}</div>
                    @endforeach
                    </tbody>
                </table>
                <br>
                <br>
            <div style="font-weight: bold;text-align: right;">Retiro: Tienda</div> 
            <div style="font-weight: bold;text-align: right;">Iva (19%) : $ {{ $iva = (($valorTotal * 1.19)-$valorTotal)}}</div> 
            <div style="font-weight: bold;text-align: right;">SubTotal: $ {{$valorTotal}}  </div>
            <div style="font-weight: bold;text-align: right;color:purple;">Total: $ {{$valorTotal+$iva}}</div>
            <br>
            <div style="font-weight: bold; text-align: center;">Fecha de emisión: {{$fecha}}</div>                       
    
</body>
</html>