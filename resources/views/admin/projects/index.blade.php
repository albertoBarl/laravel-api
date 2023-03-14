@extends('layouts.admin')
@section('content')
    <div class="p-2"><a class="btn btn-dark" href="{{ route('admin.projects.create') }}">ADD PROJECT</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Creato:</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $item)
                <tr>
                    <th scope="row">{{ $item['id'] }}</th>
                    <td>{{ $item['title'] }}</td>
                    <td>{{ $item['slug'] }}</td>
                    <td>{{ $item['created_at'] }}</td>
                    <td>
                        <div class="container d-flex justify-content-end align-items-center p-1 rounded-3 gap-2">
                            <a href="{{ route('admin.projects.show', ['project' => $item->slug]) }}"
                                class="btn btn-primary">SHOW</a>
                            <a href="{{ route('admin.projects.edit', $item) }}" class="btn btn-warning">EDIT</a>
                            <form action="{{ route('admin.projects.destroy', ['project' => $item->slug]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">DELETE</button>

                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
