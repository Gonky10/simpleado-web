<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }

        .header,
        .footer {
            width: 100%;
            color: white;
            padding: 10px;
            font-size: 24px;
            text-align: center;
        }

        .header {
            background-color: {{ $data['headerColor'] ?? 'black' }};
        }

        .footer {
            background-color: {{ $data['footerColor'] ?? 'black' }};
        }

        .content {
            margin-top: 20px;
        }

        .card {
            width: 60%;
            margin: auto;
            padding: 20px;
            background: white;
            border: 1px solid #ddd;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .image-container img {
            width: 50%;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="header">🎉 Invitación Especial 🎉</div>

    <div class="content">
        <div class="card">
            <h2>{{ $data['recipientName'] ?? '(Título)' }}</h2>
            <p>📅 Fecha: {{ $data['eventDate'] ?? '(Fecha)' }}</p>
            <p>⏰ Hora: {{ $data['eventTime'] ?? '(Hora)' }}</p>
            <p>📍 Lugar: {{ $data['eventLocation'] ?? '(Ubicación)' }}</p>

            @if (!empty($data['imageUpload']))
                <div class="image-container">
                    <img src="data:image/jpeg;base64,{{ $data['imageUpload'] }}" alt="Imagen">
                </div>
            @endif
        </div>
    </div>

    <div class="footer">Organizado por: {{ $data['organizerName'] ?? '(Organizador)' }}</div>
</body>

</html>
