@extends('template_backend.home')
@section('sub-judul','Add Data')
@section('content')

<div class="row">
    <div class="col-12 col-md-6 col-lg-6">
        <form action="{{ route('user.store') }}" method="post">
            @csrf
                <div class="form-group">
                    <label>Nama User</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">
                    @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}">
                    @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="tipe" id="" class="form-control @error('tipe') is-invalid @enderror" value="{{old('tipe')}}">
                        <option value="" holder>Pilih Status</option>
                        <option value="1">Administrator</option>
                        <option value="0">Penulis</option>
                    </select>
                    @error('tipe')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                 <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password')}}">
                    @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

        <div class="form-group">
            <button class="btn btn-primary btn-block">Save Data</button>
        </div>
</form>
</div>
</div>

@endsection