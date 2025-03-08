<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Invitación</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .header,
        .footer {
            width: 100%;
            color: white;
            padding: 10px;
            font-size: 20px;
            text-align: center;
        }

        .header {
            background-color: {{ $headerColor }};
        }

        .footer {
            background-color: {{ $footerColor }};
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
        }

        /* Tabla que ocupa el espacio entre header y footer */
        .content-table {
            width: 100%;
            height: 80%;
            /* Ajustar espacio para header y footer */
        }

        .content-table td {
            vertical-align: middle;
            text-align: center;
            height: 100%;
            padding: 0;
        }

        .card {
            display: inline-block;
            width: 60%;
            padding: 15px;
            background: white;
            border-radius: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .image-container img {
            width: 50%;
            height: auto;
            margin-top: 10px;
            border-radius: 5px;
        }

        h2 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            margin: 3px 0;
        }
    </style>
</head>

<body>

    <div class="header">🎉 Invitación Especial 🎉</div>

    <table class="content-table">
        <tr>
            <td>
                <div class="card">
                    <h2>{{ $title }}</h2>
                    <p>📅 Fecha: <strong>{{ $date }}</strong></p>
                    <p>⏰ Hora: <strong>{{ $time }}</strong></p>
                    <p>📍 Lugar: <strong>{{ $location }}</strong></p>
                    @if (!empty($base64Image))
                        <div class="image-container">
                            <img src="data:image/png;base64,{{ $base64Image }}" alt="Imagen de la invitación" />
                        </div>
                    @endif
                </div>
            </td>
        </tr>
    </table>

    <div class="footer">Organizado por: {{ $organizer }}</div>

</body>

</html>
