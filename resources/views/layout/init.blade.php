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
    <script>
        function redirectToRegister() {
            window.location.href = "{{ route('register') }}"; // Usa el nombre de la ruta
        }
    </script>
</head>

<body>
    <form action="{{ route('login') }}" method="POST">
        @csrf <!-- Token de seguridad obligatorio -->
        <div class="container-fluid" onload="updatePreview()">

            <!-- Navbar -->
            <div class="bg-black text-white card-header d-flex align-items-center justify-content-between  pt-3 pb-3">
                <div class="flex-grow-1 text-center">
                    <p class="mb-0">Simpleado</p>
                </div>
                <img src="{{ asset('images/Simpleado.png') }}" alt="Simpleado" class="logo me-2">
            </div>

            <div class="width-cont">
                <div class="container d-flex justify-content-center align-items-center mt-3">
                    <div class=" p-3 text-center text-black  mt-custom">
                        Bienvenido a Simpleado
                    </div>
                </div>


                <div>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="input-group mb-3 mtop">
                        <input type="email" class="form-control" name="email" placeholder="algo@gmail.com"
                            aria-label="Username">
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password"
                            aria-label="Username">
                    </div>
                </div>




                <div class="container d-flex flex-column justify-content-center align-items-center mt-5 gap-3">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Recordar mi sesión</label>
                    </div>
                    <button class="btn btn-outline-dark w-75" type="submit">Iniciar
                        Sesión</button>

                    <button type="button" class="btn btn-outline-dark w-75" onclick="redirectToRegister()">Registrar
                        cuenta</button>
                </div>


            </div>







        </div>
    </form>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
