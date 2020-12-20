@extends('template_backend.home')
@section('sub-judul','Tag')
@section('content')


<!-- info notif data ditambahkan -->
@if (session('status'))  
                <div class="alert alert-success">       
                  {{session('status')}}
                </div>
              @endif

    <a href="{{ route('tag.create') }}" class="btn btn-sm btn-primary mb-3">Add</a>

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Tag</th>
                <th>Slug</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tag as $result)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $result->name }}</td>
                <td>{{ $result->slug }}</td>
                <td>
                    <form action="{{ route('tag.destroy', $result->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <a href="{{ route('tag.edit', $result->id) }}" class="btn btn-success btn-sm">Edit</a>
                        <button href="" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                   
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $tag->links() }}


@endsection