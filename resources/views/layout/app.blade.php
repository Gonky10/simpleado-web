<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Simpleado')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <div class="container-fluid">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

        <div class="bg-black text-white card-header d-flex align-items-center justify-content-between pe-3 pt-3 pb-3">
            <div class="flex-grow-1 text-center">
                <p class="mb-0">Simpleado</p>
            </div>
            <img src="{{ asset('images/Simpleado.png') }}" alt="Simpleado" class="logo rounded">
        </div>

        <div class="container d-flex justify-content-center align-items-center">
            <div class=" p-3 text-center text-black m-5 mt-custom">
                Generador de Flyers
            </div>
        </div>

        <div class="container">
            <h1>Generador de Flyers</h1>

            <form id="flyerForm">
                <label for="recipientName">Título:</label>
                <input type="text" id="recipientName" name="recipientName" oninput="updatePreview()">

                <label for="eventDate">Fecha:</label>
                <input type="date" id="eventDate" name="eventDate" oninput="updatePreview()">

                <label for="eventTime">Hora:</label>
                <input type="time" id="eventTime" name="eventTime" oninput="updatePreview()">

                <label for="eventLocation">Ubicación:</label>
                <input type="text" id="eventLocation" name="eventLocation" oninput="updatePreview()">

                <label for="organizerName">Organizador:</label>
                <input type="text" id="organizerName" name="organizerName" oninput="updatePreview()">

                <label for="headerColor">Color del Header:</label>
                <input type="color" id="headerColor" name="headerColor" value="#000000" oninput="updatePreview()">

                <label for="footerColor">Color del Footer:</label>
                <input type="color" id="footerColor" name="footerColor" value="#000000" oninput="updatePreview()">

                <label for="imageUpload">Imagen:</label>
                <input type="file" id="imageUpload" name="imageUpload" accept="image/*"
                    onchange="handleImageUpload()">

                <button type="button" onclick="downloadPDF()">Descargar PDF</button>
            </form>

            <h2>Vista Previa:</h2>
            <iframe id="previewFrame" style="width: 100%; height: 500px;"></iframe>
        </div>

        <script>
            function updatePreview() {
                let recipientName = document.getElementById("recipientName").value;
                let eventDate = document.getElementById("eventDate").value;
                let eventTime = document.getElementById("eventTime").value;
                let eventLocation = document.getElementById("eventLocation").value;
                let organizerName = document.getElementById("organizerName").value;
                let headerColor = document.getElementById("headerColor").value;
                let footerColor = document.getElementById("footerColor").value;

                let base64Image = localStorage.getItem("uploadedImage") || "";

                let htmlContent = `
                    <html>
                    <head>
                        <style>
                            body { font-family: Arial, sans-serif; text-align: center; }
                            .header, .footer { color: white; padding: 10px; font-size: 24px; }
                            .header { background-color: ${headerColor}; }
                            .footer { background-color: ${footerColor}; }
                            .content { margin-top: 20px; }
                            .card { padding: 20px; border: 1px solid #ccc; display: inline-block; }
                            .image-container img { width: 50%; border-radius: 10px; }
                        </style>
                    </head>
                    <body>
                        <div class="header">🎉 Invitación Especial 🎉</div>
                        <div class="content">
                            <div class="card">
                                <h2>${recipientName || "(Título)"}</h2>
                                <p>📅 Fecha: ${eventDate || "(Fecha)"}</p>
                                <p>⏰ Hora: ${eventTime || "(Hora)"}</p>
                                <p>📍 Lugar: ${eventLocation || "(Ubicación)"}</p>
                                ${base64Image ? `<div class="image-container"><img src="${base64Image}" alt="Imagen"></div>` : ""}
                            </div>
                        </div>
                        <div class="footer">Organizado por: ${organizerName || "(Organizador)"}</div>
                    </body>
                    </html>`;

                document.getElementById("previewFrame").srcdoc = htmlContent;
            }

            function handleImageUpload() {
                let input = document.getElementById("imageUpload");
                let file = input.files[0];

                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        localStorage.setItem("uploadedImage", e.target.result);
                        updatePreview();
                    };
                    reader.readAsDataURL(file);
                }
            }

            function downloadPDF() {
                let formData = new FormData(document.getElementById("flyerForm"));
                fetch("{{ route('flyers.generatePDF') }}", {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    })
                    .then(response => response.blob())
                    .then(blob => {
                        let url = window.URL.createObjectURL(blob);
                        let a = document.createElement("a");
                        a.href = url;
                        a.download = "flyer.pdf";
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);
                    })
                    .catch(error => console.error("Error al generar PDF:", error));
            }

            document.addEventListener("DOMContentLoaded", updatePreview);
        </script>


        <main>
            @yield('content')
        </main>


    </div>
</body>

</html>
