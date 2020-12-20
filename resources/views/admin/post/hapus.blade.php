@extends('template_backend.home')
@section('sub-judul','Post Trush')
@section('content')


 <!-- info notif data ditambahkan -->
             @if (session('status'))  
                <div class="alert alert-success">       
                  {{session('status')}}
                </div>
              @endif


    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Tag</th>
                <!-- <th>Slug</th> -->
                <th>Gambar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($post as $result)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $result->judul }}</td>
                <td>{{ $result->category->name }}</td>
                <td>@foreach($result->tags as $tag)
                    <ul>
                        <li>{{ $tag->name }}</li>
                    </ul>
                    @endforeach
                </td>
                <!-- <td>{{ $result->slug }}</td> -->
                <td><img src="{{ asset($result->gambar) }}" class="img-fluid" width="70"></td>
                <td>
                    <form action="{{ route('post.kill', $result->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <a href="{{ route('post.restore', $result->id) }}" class="btn btn-success btn-sm">Restore</a>
                        <button href="" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                   
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $post->links() }}

@endsection