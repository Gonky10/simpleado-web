@extends('layout.app')

@section('title', 'Lista de Flyers')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <h1>Lista de Flyers</h1>
        <a href="{{ route('flyers.create') }}">Crear Nuevo Flyer</a>

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Ubicación</th>
                    <th>Organizador</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($flyers as $flyer)
                    <tr>
                        <td>{{ $flyer->id }}</td>
                        <td>{{ $flyer->title }}</td>
                        <td>{{ $flyer->event_date }}</td>
                        <td>{{ $flyer->event_time }}</td>
                        <td>{{ $flyer->event_location }}</td>
                        <td>{{ $flyer->organizer_name }}</td>
                        <td>
                            <a href="{{ route('flyers.edit', $flyer->id) }}">Editar</a> |
                            <form action="{{ route('flyers.destroy', $flyer->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
