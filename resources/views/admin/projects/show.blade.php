@extends('layouts.admin')

@section('content')
    <div class="container">
      @if (session('success'))
         <div class="alert alert-success">
             {{ session('success') }}
         </div>
       @endif
        <div class="row">
            <div class="col d-flex align-items-center flex-column gap-4">
                <h2>Project information</h2>
                
                <div class="card" style="width: 60%;">
                    @if ($project->image)
                      <div class="text-center py-3" >
                        <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top ms-card-img" alt="{{ $project->name }}">
                      </div>
                    @else
                        <div class="d-flex justify-content-center align-items-center py-3" >
                            <div>No uploaded image</div>
                        </div>
                    @endif
                    <div class="card-body">
                      <p class="card-title"><strong>Project name:</strong> {{ $project->name }}</p>
                      <p class="card-text"><strong>Slug</strong>: {{ $project->slug }}</p>
                      <p class="card-text"><strong>Client name</strong>: {{ $project->client_name }}</p>
                      @if ($project->summary )
                        <p class="card-text"><strong>Summary:</strong> {{ $project->summary }}</p>
                      @endif
                      <p class="card-text"><strong>Date of creation:</strong> {{ $project->created_at }}</p>
                      <p class="card-text"><strong>Last updated:</strong> {{ $project->updated_at }}</p>
                      <div class="d-flex gap-3">
                        <a href="{{ route('admin.projects.edit', ['project' => $project->slug]) }}" class="btn btn-primary">Edit</a>
                      <form action="{{ route('admin.projects.destroy', ['project' => $project->slug]) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection