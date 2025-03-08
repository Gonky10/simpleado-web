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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show text-center m-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="divdetodo">
            <iframe id="previewFrame"></iframe>
        </div>

        <!-- Formulario -->
        <div class="container marginFormFlyers">
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
                <div class="container d-flex justify-content-center align-items-center mt-5 mb-5">
                    <button type="button" class="btn btn-outline-dark" onclick="downloadPDF()">Descargar
                        PDF</button>
                </div>
            </form>
        </div>

        <!-- Vista Previa -->
        <div class="container preview-container">

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
        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            height: 100vh;
        }

        .header, .footer {
            width: 100%;
            color: white;
            padding: 1rem;
            font-size: 24px;
            text-align: center;
        }

        .header {
            background-color: ${headerColor};
            flex-shrink: 0;
        }

        .footer {
            background-color: ${footerColor};
            flex-shrink: 0;
        }

        .content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .card {
            width: 50%;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .image-container img {
            width: 50%;
            height: auto;
            margin-top: 20px;
            border-radius: 10px;
        }

        h2 {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        p {
            font-size: 18px;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="header">🎉 Invitación Especial 🎉</div>
    <div class="content">
        <div class="card">
            <h2>${title}</h2>
            <p>📅 Fecha: <strong>${date}</strong></p>
            <p>⏰ Hora: <strong>${time}</strong></p>
            <p>📍 Lugar: <strong>${location}</strong></p>
            ${
                base64Image
                    ? `<div class="image-container">
                                                                                                        <img src="${base64Image}" alt="Imagen Seleccionada"/>
                                                                                                    </div>`
                    : ''
            }
        </div>
    </div>
    <div class="footer">Organizado por: ${organizer}</div>
</body>
</html>

    `;

            let iframe = document.getElementById("previewFrame");
            iframe.srcdoc = previewHTML;
        }

        function downloadPDF() {
            let title = document.getElementById("recipientName").value || "Título";
            let date = document.getElementById("eventDate").value || "Fecha";
            let time = document.getElementById("eventTime").value || "Hora";
            let location = document.getElementById("eventLocation").value || "Ubicación";
            let organizer = document.getElementById("organizerName").value || "Organizador";
            let headerColor = document.getElementById("headerColor").value || "#000000";
            let footerColor = document.getElementById("footerColor").value || "#000000";
            let base64Image = window.base64Image || "";

            console.log("✅ Datos a enviar:");
            console.log("Title:", title);
            console.log("Date:", date);
            console.log("Time:", time);
            console.log("Location:", location);
            console.log("Organizer:", organizer);
            console.log("Header Color:", headerColor);
            console.log("Footer Color:", footerColor);
            console.log("Base64 Image:", base64Image.substring(0, 50) + "..."); // Solo muestra una parte de la imagen

            let formData = new FormData();
            formData.append("title", title);
            formData.append("date", date);
            formData.append("time", time);
            formData.append("location", location);
            formData.append("organizer", organizer);
            formData.append("headerColor", headerColor);
            formData.append("footerColor", footerColor);
            formData.append("base64Image", base64Image);

            console.log("🚀 Enviando datos al backend...: ", formData);

            fetch("http://localhost/Simpleado/public/descargar-pdf", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    }
                })
                .then(response => {
                    console.log("📩 Respuesta recibida:", response);
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.blob();
                })
                .then(blob => {
                    console.log("✅ PDF recibido, iniciando descarga...");
                    let link = document.createElement("a");
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "flyer.pdf";
                    link.click();
                })
                .catch(error => {
                    console.error("❌ Error generando PDF:", error);
                    alert("Hubo un error generando el PDF. Revisa la consola para más detalles.");
                });
        }


        window.onload = function() {
            updatePreview();
        };
    </script>

</body>

</html>
