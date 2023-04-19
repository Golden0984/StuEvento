@extends('layouts.app')

@section('content')
    <h1>{{ $event->title }}</h1>
    <p>{{ $event->description }}</p>
    <p><strong>Ubicación:</strong> {{ $event->location }}</p>
    <p><strong>Fecha:</strong> {{ $event->date }}</p>
    <hr>
    <h2>Asistentes</h2>
    <ul>
        @foreach($event->attendees as $attendee)
            <li>{{ $attendee->user->name }}</li>
        @endforeach
    </ul>
    <hr>
    <a href="{{ route('events.edit', ['id' => $event->id]) }}" class="btn btn-primary">Editar</a>
    <a href="{{ route('events.register', ['id' => $event->id]) }}" class="btn btn-success">Registrar asistente</a>
@endsection
