<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Recibo #{{ $transaction->id }}</title>
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

            /* Typography */
            h1 {
                color: #66cdaa;
                font-size: 20px;
                margin: 0 0 10px 0;
                text-align: center;
                text-transform: uppercase;
            }
            
            h2 {
                color: #66cdaa;
                font-size: 14px;
                margin: 20px 0 10px 0;
                text-transform: uppercase;
                border-bottom: 2px solid #66cdaa;
                padding-bottom: 5px;
            }

            /* Info Section */
            .info-table {
                width: 100%;
                margin-bottom: 20px;
                border-collapse: collapse;
            }
            .info-table td {
                vertical-align: top;
                padding: 5px;
            }
            .text-right { text-align: right; }
            .text-center { text-align: center; }
            .text-teal { color: #66cdaa; font-weight: bold; }
            .text-uppercase { text-transform: uppercase; }
            
            /* Receipt Box */
            .receipt-box {
                background-color: #f9f9f9;
                border: 2px solid #66cdaa;
                border-radius: 8px;
                padding: 20px;
                margin: 20px 0;
            }
            
            .receipt-row {
                display: table;
                width: 100%;
                margin-bottom: 12px;
            }
            
            .receipt-label {
                display: table-cell;
                width: 40%;
                font-weight: bold;
                color: #333;
                text-transform: uppercase;
                font-size: 11px;
            }
            
            .receipt-value {
                display: table-cell;
                width: 60%;
                color: #555;
                font-size: 12px;
            }
            
            .amount-box {
                background-color: #66cdaa;
                color: white;
                padding: 15px;
                text-align: center;
                border-radius: 5px;
                margin: 20px 0;
            }
            
            .amount-label {
                font-size: 11px;
                text-transform: uppercase;
                margin-bottom: 5px;
            }
            
            .amount-value {
                font-size: 28px;
                font-weight: bold;
            }
            
            /* Balance Table */
            .balance-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            
            .balance-table tr {
                border-bottom: 1px solid #eee;
            }
            
            .balance-table td {
                padding: 10px;
                font-size: 12px;
            }
            
            .balance-table .label-col {
                width: 70%;
                color: #555;
            }
            
            .balance-table .value-col {
                width: 30%;
                text-align: right;
                font-weight: bold;
                color: #333;
            }
            
            .balance-table .total-row td {
                border-top: 2px solid #66cdaa;
                padding-top: 15px;
                font-size: 14px;
                color: #66cdaa;
            }
            
            /* Footer text */
            .footer-text {
                margin-top: 40px;
                text-align: center;
                font-size: 10px;
                color: #999;
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

        <h1>Recibo de Pago N.º {{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</h1>

        <table class="info-table">
            <tr>
                <td width="50%">
                    <h2 style="font-size: 12px;">Cliente</h2>
                    <p>
                        <strong>{{ $transaction->event->client->name }}</strong><br>
                        @if($transaction->event->client->phone)
                            Tel: {{ $transaction->event->client->phone }}<br>
                        @endif
                        @if($transaction->event->client->email)
                            Email: {{ $transaction->event->client->email }}
                        @endif
                    </p>
                </td>
                
                <td width="50%" class="text-right">
                    <p>
                        <strong>Fecha de emisión:</strong> {{ $transaction->date->format('d/m/Y') }}<br>
                        <strong>Evento:</strong> {{ $transaction->event->detail }}<br>
                        @if($transaction->event->event_date)
                            <strong>Fecha del evento:</strong> {{ $transaction->event->event_date->format('d/m/Y') }}
                        @endif
                    </p>
                </td>
            </tr>
        </table>

        <div class="amount-box">
            <div class="amount-label">Monto Recibido</div>
            <div class="amount-value">${{ number_format($transaction->amount, 0, ',', '.') }}</div>
        </div>

        <div class="receipt-box">
            <div class="receipt-row">
                <div class="receipt-label">Concepto:</div>
                <div class="receipt-value">{{ $transaction->description }}</div>
            </div>
            
            @if($transaction->payment_method)
            <div class="receipt-row">
                <div class="receipt-label">Método de Pago:</div>
                <div class="receipt-value">{{ ucfirst($transaction->payment_method) }}</div>
            </div>
            @endif
            
            <div class="receipt-row">
                <div class="receipt-label">Fecha de Pago:</div>
                <div class="receipt-value">{{ $transaction->date->format('d/m/Y') }}</div>
            </div>
            
            @if($transaction->event->service_type)
            <div class="receipt-row">
                <div class="receipt-label">Tipo de Servicio:</div>
                <div class="receipt-value">{{ $transaction->event->service_type == 'rental' ? 'Alquiler' : 'Decoración' }}</div>
            </div>
            @endif
        </div>

        <h2>Estado de Cuenta del Evento</h2>
        
        <table class="balance-table">
            <tr>
                <td class="label-col">Total del Evento</td>
                <td class="value-col">${{ number_format($transaction->event->total_amount ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label-col">Total Pagado</td>
                <td class="value-col">${{ number_format($income, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td class="label-col">Saldo Pendiente</td>
                <td class="value-col">${{ number_format(($transaction->event->total_amount ?? 0) - $income, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="footer-text">
            Este recibo es un comprobante de pago válido.<br>
            Gracias por su confianza.
        </div>

    </body>
</html>
