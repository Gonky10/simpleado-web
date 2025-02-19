<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Simpleado')</title>

    <!-- Estilos -->

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>
    <div class="container-fluid" onload="updatePreview()">

        <!-- Navbar -->
        <div class="bg-black text-white card-header d-flex align-items-center justify-content-between  pt-3 pb-3">
            <div class="flex-grow-1 text-center">
                <p class="mb-0">Simpleado</p>
            </div>
            <img src="{{ asset('images/Simpleado.png') }}" alt="Simpleado" class="logo me-2">
        </div>

        <!-- Título -->
        <div class="container d-flex justify-content-center align-items-center">
            <div class=" p-3 text-center text-black mt-5 mt-custom">
                Generador de Flyers
            </div>
        </div>
        <!-- Formulario -->
        <div class="container mt-3">
            <form id="flyerForm">
                <div class="mb-3">
                    <label for="recipientName" class="form-label">Título:</label>
                    <input type="text" class="form-control" id="recipientName" name="recipientName"
                        oninput="updatePreview()">
                </div>

                <div class="mb-3">
                    <label for="eventDate" class="form-label">Fecha:</label>
                    <input type="date" class="form-control" id="eventDate" name="eventDate"
                        oninput="updatePreview()">
                </div>

                <div class="mb-3">
                    <label for="eventTime" class="form-label">Hora:</label>
                    <input type="time" class="form-control" id="eventTime" name="eventTime"
                        oninput="updatePreview()">
                </div>

                <div class="mb-3">
                    <label for="eventLocation" class="form-label">Ubicación:</label>
                    <input type="text" class="form-control" id="eventLocation" name="eventLocation"
                        oninput="updatePreview()">
                </div>

                <div class="mb-3">
                    <label for="organizerName" class="form-label">Organizador:</label>
                    <input type="text" class="form-control" id="organizerName" name="organizerName"
                        oninput="updatePreview()">
                </div>

                <div class="mb-3">
                    <label for="headerColor" class="form-label">Color del Header:</label>
                    <input type="color" class="form-control form-control-color" id="headerColor" name="headerColor"
                        value="#000000" oninput="updatePreview()">
                </div>

                <div class="mb-3">
                    <label for="footerColor" class="form-label">Color del Footer:</label>
                    <input type="color" class="form-control form-control-color" id="footerColor" name="footerColor"
                        value="#000000" oninput="updatePreview()">
                </div>

                <div class="mb-3">
                    <label for="imageUpload" class="form-label">Imagen:</label>
                    <input type="file" class="form-control" id="imageUpload" name="imageUpload" accept="image/*"
                        onchange="handleImageUpload()">
                </div>
                <div class="container d-flex justify-content-center align-items-center mt-5">
                    <button type="button" class="btn btn-outline-dark" onclick="downloadPDF()">Descargar PDF</button>
                </div>
            </form>
        </div>

        <!-- Vista Previa -->
        <div class="container preview-container">

        </div>


        <div class="ratio ratio-1x1">
            <iframe id="previewFrame" class="mb-5"></iframe>
        </div>

    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        let base64Image = ""; // Variable global para almacenar la imagen en base64

        function handleImageUpload() {
            const fileInput = document.getElementById("imageUpload");
            const file = fileInput.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onloadend = function() {
                    base64Image = reader.result; // Almacena la imagen en base64
                    updatePreview(); // Llama a la función de actualización para reflejar cambios
                };
                reader.readAsDataURL(file);
            }
        }

        function updatePreview() {
            let title = document.getElementById("recipientName").value || "(Título)";
            let date = document.getElementById("eventDate").value || "(Fecha)";
            let time = document.getElementById("eventTime").value || "(Hora)";
            let location = document.getElementById("eventLocation").value || "(Ubicación)";
            let organizer = document.getElementById("organizerName").value || "(Organizador)";
            let headerColor = document.getElementById("headerColor").value || "#000000";
            let footerColor = document.getElementById("footerColor").value || "#000000";

            let previewHTML = `
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; text-align: center; padding: 20px; }
                .header, .footer {
                    width: 100%;
                    color: white;
                    padding: 10px;
                    font-size: 24px;
                    text-align: center;
                }
                .header { background-color: ${headerColor}; }
                .footer { background-color: ${footerColor}; }
                .card {
                    width: 60%;
                    margin: auto;
                    padding: 20px;
                    background: white;
                    border: 1px solid #ddd;
                    box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
                }
                .image-container img {
                    width: 40%;
                    height: auto;
                    margin-top: 10px;
                    border-radius: 10px;
                }
            </style>
        </head>
        <body>
            <div class="header">🎉 Invitación Especial 🎉</div>
            <div class="card">
                <h2>${title}</h2>
                <p>📅 Fecha: ${date}</p>
                <p>⏰ Hora: ${time}</p>
                <p>📍 Lugar: ${location}</p>
                ${
                    base64Image
                        ? `<div class="image-container">
                                                    <img src="${base64Image}" alt="Imagen Seleccionada"/>
                                                  </div>`
                        : ''
                }
            </div>
            <div class="footer">Organizado por: ${organizer}</div>
        </body>
        </html>
    `;

            let iframe = document.getElementById("previewFrame");
            iframe.srcdoc = previewHTML;
        }

        function downloadPDF() {
            alert("Aquí iría la lógica para descargar el PDF");
        }
        window.onload = function() {
            updatePreview();
        };
    </script>

</body>

</html>
