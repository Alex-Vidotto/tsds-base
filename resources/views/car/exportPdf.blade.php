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
            margin: 20px;
        }
        .vehiculo {
            page-break-after: always;
        }
        .header {
            border-bottom: 1px solid #aaa;
            margin-bottom: 10px;
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
    </style>
</head>
<body>
    @foreach($cars as $car)
        <div class="vehiculo">
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
                @if($car->fichaTecnica)
                    <div class="seccion">
                        <h4>Ficha Técnica</h4>
                        <p><strong>Motor:</strong> {{ $car->fichaTecnica->motor }}</p>
                        <p><strong>Combustible:</strong> {{ $car->fichaTecnica->combustible }}</p>
                        <p><strong>Transmisión:</strong> {{ $car->fichaTecnica->transmision }}</p>
                        <p><strong>Color:</strong> {{ $car->fichaTecnica->color }}</p>
                        <p><strong>Año:</strong> {{ $car->fichaTecnica->anio }}</p>
                    </div>
                @else
                    <p><em>No hay ficha técnica registrada.</em></p>
                @endif
            </div>

            <div class="seccion">
                <h4>Historial de Mantenimiento</h4>
                <p><em>Espacio reservado para registrar mantenimientos realizados.</em></p>
            </div>
        </div>
    @endforeach
</body>
</html>