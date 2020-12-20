@extends('template_backend.home')
@section('sub-judul','Add Data')
@section('content')


<div class="row">
    <div class="col-12 col-md-6 col-lg-6">
        <form action="{{ route('category.store') }}" method="post">
            @csrf
                <div class="form-group">
                    <label>category</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">
                    @error('name')
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