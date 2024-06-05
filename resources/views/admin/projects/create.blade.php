@extends('layouts.admin')

@section('content')
<section>
  <h2 class="mb-3">Create New Project:</h2>
  @if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
  @endif

  <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
          <label for="name" class="form-label">Project Name</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
      </div>
      <div class="mb-3">
          <label for="cient_name" class="form-label">Client Name</label>
          <input type="text" class="form-control" id="client_name" name="client_name" value="{{ old('client_name') }}">
      </div>
      <div class="mb-3">
        <label for="image" class="form-label">Upload Image</label>
        <input class="form-control" type="file" id="image" name="image">
      </div>
      <div class="mb-3">
          <label for="summary" class="form-label">Summmary</label>
          <textarea class="form-control" id="description" rows="15" name="summary">{{ old('summary') }}</textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</section>
@endsection