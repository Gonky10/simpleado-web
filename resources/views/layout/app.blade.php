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
        <div class="container-sm bg-black">100% wide until small breakpoint</div>

        <main>
            @yield('content')
        </main>


    </div>
</body>

</html>
