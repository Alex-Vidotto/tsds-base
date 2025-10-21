<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe Individual de Vehículos</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #333;
            margin: 0;
            padding: 20px;
            padding-left: 120px; 
        }

        
        .page-logo {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1;
            width: 90px; 
        }

        .page-logo img {
            height: 60px; 
            width: auto;
        }

        .vehiculo {
            margin-bottom: 20px;
        }

        .header {
            border-bottom: 1px solid #aaa;
            margin-bottom: 10px;
            padding-bottom: 5px;
        }

        .header h2 {
            margin: 5px 0;
        }

        .foto {
            margin-top: 10px;
        }

        .foto img {
            max-width: 250px;
            height: auto;
            border: 1px solid #ccc;
        }

        .datos {
            margin-top: 10px;
        }

        .datos p {
            margin: 4px 0;
        }

        .seccion {
            margin-top: 15px;
            padding: 10px;
            border: 1px dashed #999;
        }

        .seccion h4 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <!-- Logo -->
    <div class="page-logo">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo de la empresa">
    </div>

    @foreach($cars as $car)
        <div class="vehiculo" @if(!$loop->last) style="page-break-after: always;" @endif>
            <div class="header">
                <h2>Vehículo: {{ $car->matricula }}</h2>
                <p><strong>Fecha de Registro:</strong> {{ $car->created_at->format('d/m/Y') }}</p>
            </div>

            <div class="foto">
                @if($car->foto)
                    <img src="{{ public_path('images/vehiculos/' . $car->foto) }}" alt="Foto del vehículo">
                @else
                    <p><em>Sin foto disponible</em></p>
                @endif
            </div>

            <div class="datos">
                <p><strong>Marca:</strong> {{ $car->carModel->carBrand->nombre }}</p>
                <p><strong>Modelo:</strong> {{ $car->carModel->nombre }}</p>
            </div>

            <div class="seccion">
                <h4>Ficha Técnica</h4>
                @if($car->fichaTecnica)
                    <p><strong>Motor:</strong> {{ $car->fichaTecnica->motor }}</p>
                    <p><strong>Combustible:</strong> {{ $car->fichaTecnica->combustible }}</p>
                    <p><strong>Transmisión:</strong> {{ $car->fichaTecnica->transmision }}</p>
                    <p><strong>Color:</strong> {{ $car->fichaTecnica->color }}</p>
                    <p><strong>Año:</strong> {{ $car->fichaTecnica->anio }}</p>
                @else
                    <p><em>No hay ficha técnica registrada.</em></p>
                @endif
            </div>

            <div class="seccion">
                <h4>Historial de Mantenimiento</h4>
                @if($car->carServiceDates->isNotEmpty())
                    <table width="100%" style="border-collapse: collapse; margin-top: 10px;">
                        <thead>
                            <tr>
                                <th style="border-bottom: 1px solid #999; text-align: left;">Fecha</th>
                                <th style="border-bottom: 1px solid #999; text-align: left;">Tipo de Servicio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($car->carServiceDates as $registro)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($registro->fecha_mantenimiento)->format('d/m/Y') }}</td>
                                    <td>{{ $registro->carService->Tipo_servicio }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p><em>No hay mantenimientos registrados.</em></p>
                @endif
            </div>
        </div>
    @endforeach
</body>
</html>