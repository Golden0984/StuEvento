@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mis eventos</h1>
        <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">Crear evento</a>
        @if ($events)
        <div class="row">
        @foreach ($events as $event)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"> Titulo: {{ $event->title }}</h5>
                            <p class="card-text">Description: {{ $event->description }}</p>
                            <p class="card-text">Ubicación: {{ $event->location }}</p>
                            <p class="card-text">Fecha: {{ $event->date }}</p>
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">Ver detalles</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @else
            <p>No hay eventos para mostrar.</p>
        @endif
    </div>
@endsection
