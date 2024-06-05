@extends('layouts.admin')

@section('content')
<section>
  <h2 class="mb-3">Edit project: {{ $project->name }}</h2>
  @if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
  @endif

  <form action="{{ route('admin.projects.update', ['project' => $project->slug]) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label for="name" class="form-label">Project Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $project->name )}}">
      </div>
      <div class="mb-3">
          <label for="cient_name" class="form-label">Client Name</label>
          <input type="text" class="form-control" id="client_name" name="client_name" value="{{ old('client_name', $project->client_name) }}">
      </div>
      <div class="mb-3">
          <label for="image" class="form-label">Upload Image</label>
          <input class="form-control" type="file" id="image" name="image">
      </div>
      <div class="mb-3" >
        <label for="type_id" class="form-label" >Select a Type</label>
        <select class="form-select"  id="type_id"  name="type_id" aria-label="Default select example">
          <option selected>Open this select menu</option>
          @foreach ($types as $type)
            <option value="{{ $type->id }}">{{ $type->name }}</option>
          @endforeach
        </select>
      </div>
      @if ($project->image)
          <div class="ms-img-container py-3">
            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->name }}">
          </div>
      @else
        <div class="py-3 pb-4" >
          <small>No uploaded image</small>
        </div>
      @endif
        <div class="mb-3">
          <label for="summary" class="form-label">Summmary</label>
          <textarea class="form-control" id="description" rows="15" name="summary">{{ old('summary', $project->summary) }}</textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</section>
@endsection