@extends('layouts.admin')

@section('content')
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Slug</th>
            <th scope="col">Client Name</th>
            <th scope="col">Date of creation</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($projects as $singleProject)
            <tr>
                <td>{{$singleProject->id}}</td>
                <td>{{$singleProject->name}}</td>
                <td>{{$singleProject->slug}}</td>
                <td>{{$singleProject->client_name}}</td>
                <td>{{$singleProject->created_at}}</td>
                <td class="d-flex justify-content-between gap-3" >
                    <div><a href="{{ route('admin.projects.show', ['project' => $singleProject->slug]) }}"><i class="fa-solid fa-ellipsis"></i></a></div>
                    <div><a href="{{ route('admin.projects.edit', ['project' => $singleProject->slug]) }}"><i class="fa-solid fa-pen-to-square"></i></a></div>
                    <form action="{{ route('admin.projects.destroy', ['project' => $singleProject->slug]) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="ms-button"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                </td>
            </tr>
          @endforeach
         
        </tbody>
      </table>
@endsection