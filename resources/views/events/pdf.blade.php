<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Presupuesto #{{ $event->id }}</title>
        <style>
            @page {
                margin: 0cm 0cm;
            }
            body {
                margin-top: 4cm;
                margin-left: 1cm;
                margin-right: 1cm;
                margin-bottom: 3cm;
                font-family: 'DejaVu Sans', sans-serif;
                color: #555;
                font-size: 12px;
            }

            /* Header & Footer */
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 4cm;
                background-repeat: no-repeat;
                background-size: cover;
                z-index: -1000;
            }
            img.header-img {
                width: 100%;
                height: auto;
                object-fit: cover;
            }

            footer {
                position: fixed;
                bottom: 0cm;
                left: 0cm;
                right: 0cm;
                height: 1.8cm;
                background-repeat: no-repeat;
                background-size: cover;
                z-index: -1000;
            }
            img.footer-img {
                width: 100%;
                height: auto;
                object-fit: cover;
            }

            /* Info Section */
            .info-table {
                width: 100%;
                margin-bottom: 20px;
            }
            .info-table td {
                vertical-align: top;
            }
            .text-right { text-align: right; }
            .text-teal { color: #66cdaa; font-weight: bold; } /* Teal color */
            .text-uppercase { text-transform: uppercase; }
            
            h1 {
                color: #66cdaa;
                font-size: 16px;
                margin: 0;
                text-align: right;
                text-transform: uppercase;
            }
            
            .client-info strong {
                color: #333;
                text-transform: uppercase;
                font-size: 0.9em;
            }

            /* Items Table */
            .items-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            .items-table thead th {
                background-color: #8fd3c5; /* Light Teal */
                color: white;
                text-transform: uppercase;
                padding: 10px;
                text-align: left;
                font-weight: bold;
                border: none;
            }
            .items-table tbody td {
                padding: 12px 10px;
                border-bottom: 1px solid #eee;
                color: #555;
            }
            .items-table .desc-col { width: 50%; }
            .items-table .price-col { width: 15%; }
            .items-table .qty-col { width: 15%; text-align: center; }
            .items-table .total-col { width: 20%; text-align: right; }

            .total-row td {
                padding-top: 15px;
                font-weight: bold;
                font-size: 1em;
                color: #333;
            }
            
            /* Gallery */
            .gallery-title {
                margin-top: 40px;
                margin-bottom: 15px;
                color: #66cdaa;
                border-bottom: 2px solid #eee;
                padding-bottom: 5px;
            }
            .gallery-table {
                width: 100%;
                border-collapse: collapse;
            }
            .gallery-table td {
                width: 25%;
                padding: 5px;
                text-align: center;
            }
            .gallery-img {
                width: auto;
                height: 120px;
                object-fit: contain;
                border: 1px solid #ddd;
                padding: 2px;
            }
        </style>
    </head>
    <body>

        <header>
            <img src="{{ public_path('img/pdf/header.png') }}" class="header-img"/>
        </header>

        <footer>
            <img src="{{ public_path('img/pdf/footer.png') }}" class="footer-img"/>
        </footer>

        <h1 style="text-align: right;">Presupuesto N.º {{ str_pad($event->id, 5, '0', STR_PAD_LEFT) }}</h1>
        <table class="info-table">
            <tr>
                <!-- Left Side: Client Info -->
                <td width="50%" class="client-info">
                    <h3 style="color: #66cdaa; font-size: 12px; margin-bottom: 0; text-transform: uppercase;">Cliente</h3>
                    <p style="margin-top: 0;">
                        <strong>{{ $event->client->name }}</strong><br>
                        @if($event->client->phone)
                            Tel: {{ $event->client->phone }}<br>
                        @endif
                        @if($event->client->email)
                            Email: {{ $event->client->email }}
                        @endif
                    </p>
                </td>
                
                <!-- Right Side: Event Info -->
                <td width="50%" class="text-right">
                    <p>
                        <strong>Fecha de emisión:</strong> {{ now()->format('d/m/y') }}<br>
                        <strong>Servicio:</strong> {{ $event->service_type == 'rental' ? 'Alquiler' : 'Decoración' }}
                        @if($event->eventType)
                            - {{ $event->eventType->name }}
                        @endif
                        @if($event->event_date)
                            <br><strong>Fecha del evento:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/y') }}
                        @endif
                    </p>
                </td>
            </tr>
        </table>

        <table class="items-table">
            <thead>
                <tr>
                    <th class="desc-col">DESCRIPCIÓN</th>
                    <th class="price-col">PRECIO U.</th>
                    <th class="qty-col">CANTIDAD</th>
                    <th class="total-col">IMPORTE</th>
                </tr>
            </thead>
            <tbody>
                <!-- Custom Row for Service Type/Description -->
                @if($event->detail)
                <tr>
                    <td>
                        <strong class="text-teal text-uppercase">{{ $event->service_type == 'rental' ? 'ALQUILER DE' : 'SERVICIO DE DECORACIÓN' }}</strong><br>
                        {{ $event->detail }}
                    </td>
                    <td>-</td>
                    <td style="text-align: center">1</td>
                    <td class="text-right">-</td>
                </tr>
                @endif

                <!-- Items -->
                @foreach($event->items as $item)
                <tr>
                    <td>
                        <strong class="text-teal text-uppercase">{{ $item->product_name }}</strong>
                        @if($item->description)
                            <br><span style="font-size: 0.85em; color: #777;">{{ $item->description }}</span>
                        @endif
                    </td>
                    <td>${{ number_format($item->unit_price, 0, ',', '.') }}</td>
                    <td style="text-align: center">{{ $item->quantity }}</td>
                    <td class="text-right">${{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="3" class="text-right" style="color: #66cdaa; padding-right: 15px;">TOTAL</td>
                    <td class="text-right">${{ number_format($event->total_amount, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        @if($event->notes)
            <div style="margin-top: 30px; font-size: 0.9em;">
                <strong>NOTAS:</strong> <br>
                {!! nl2br(e($event->notes)) !!}
            </div>
        @endif

        <!-- Image Gallery -->
        @if($event->images->count() > 0)
            <!-- Page Break if needed -->
            <div style="page-break-inside: avoid;">
                <h3 class="gallery-title">GALERÍA DE REFERENCIA</h3>
                <table class="gallery-table">
                    <tr>
                        @foreach($event->images as $index => $image)
                            @if($index > 0 && $index % 4 == 0)
                                </tr><tr>
                            @endif
                            <td>
                                <img src="{{ public_path('storage/' . $image->image_path) }}" class="gallery-img">
                            </td>
                        @endforeach
                        
                        <!-- Fill empty cells -->
                        @php $remaining = 4 - ($event->images->count() % 4); @endphp
                        @if($remaining < 4)
                            @for($i = 0; $i < $remaining; $i++)
                                <td></td>
                            @endfor
                        @endif
                    </tr>
                </table>
            </div>
        @endif

        <div style="margin-top: 30px; font-size: 0.85em; color: #333;">
            <strong style="text-transform: uppercase;">SE REQUIERE DE UN ANTICIPO DEL 20%</strong>
            <ul style="padding-left: 0; margin-top: 10px; list-style-type: none; line-height: 1.2;">
                <li>• Con la seña aseguras la fecha</li>
                <li>• Se mantiene congelado el precio</li>
                <li>• <img src="{{ public_path('img/pdf/pin.png') }}" style="width: 12px; vertical-align: middle;"> Las fechas para Candy Bar y decoración se encuentran con mucha demanda.</li>
                <li>• <img src="{{ public_path('img/pdf/hand.png') }}" style="width: 12px; vertical-align: middle;"> Te recomendamos confirmar lo antes posible para asegurar tu lugar.</li>
            </ul>
        </div>

    </body>
</html>
