@extends('layouts.admin')

@section('content')
    <div class="p-5">
        <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}"
            class="d-block bg-dark p-1 rounded" style="width: 250px">
        Titolo:
        <h3 class="bg-dark text-white p-3 rounded">{{ $project->title }}</h3>
        Contenuto:
        <p class="bg-dark text-white p-3 rounded">{{ $project->content }}</p>
        Tipo:
        <p class="bg-dark text-white p-3 rounded"> {{ $project->type->name ?? 'Nessun tipo' }}</p>
        Related to:
        <p class="bg-dark text-white p-3 rounded">
            @foreach ($project->technologies as $technology)
                |{{ $technology->name ?? 'Nessun tipo' }}|
            @endforeach
        </p>

    </div>
@endsection
