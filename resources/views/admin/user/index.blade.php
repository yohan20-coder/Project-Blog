@extends('template_backend.home')
@section('sub-judul','Manajemen User')
@section('content')


<!-- info notif data ditambahkan -->
@if (session('status'))  
                <div class="alert alert-success">       
                  {{session('status')}}
                </div>
              @endif

    <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary mb-3">Add</a>

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($user as $result)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $result->name }}</td>
                <td>{{ $result->email }}</td>
                <td>
                <!-- boolean 1 = true 0 = false -->
                    @if($result->tipe)         
                       <span class="badge badge-primary">Administrator</span> 
                    @else
                    <span class="badge badge-warning">Penulis</span>
                    @endif               
               </td>
                <td>
                    <form action="{{ route('user.destroy', $result->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <a href="{{ route('user.edit', $result->id) }}" class="btn btn-success btn-sm">Edit</a>
                        <button href="" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                   
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $user->links() }}


@endsection