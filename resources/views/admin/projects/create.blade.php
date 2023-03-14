@extends('layouts.admin')

@section('content')
    <div id="create-project">
        <form action="{{ route('admin.projects.store') }}" method="POST" class="d-flex flex-column justify-content-center p-5"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label><br>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content:</label><br>
                <textarea rows="5" class="form-control" name="content"></textarea>
            </div>
            <div class="mb-3">
                <label for="type_id" class="form-label">Types:</label><br>
                <select name="type_id" id="type_id">
                    <option value="">Seleziona categoria</option>
                    @foreach ($types as $item)
                        <option value="{{ $item->id }}"> {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="control-label ">Related to:</label>
                @foreach ($technologies as $technology)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="technologies[]" value="{{ $technology->id }}"
                            id="technology">
                        <label class="form-check-label" for="technology">
                            {{ $technology->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="mb-3">
                <label class="control-label">Image: </label>
                <input type="file" name="cover_image" id="cover_image" class="form-control
                ">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add project</button>
            </div>
        </form>

    </div>
@endsection
