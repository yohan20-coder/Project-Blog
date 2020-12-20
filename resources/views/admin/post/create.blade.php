@extends('template_backend.home')
@section('sub-judul','Add Data')
@section('content')

        <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{old('judul')}}">
                    @error('judul')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" id="" class="form-control">
                    <option value="" holder>Pilih Kategori</option>
                    @foreach($category as $result)
                       <option value="{{ $result->id }}">{{ $result->name }}</option>
                    @endforeach
                    </select>                  
                </div>

                <div class="form-group">
                    <label>Tags</label>
                    <select name="tags[]" id="" class="form-control select2" multiple="">
                    @foreach($tags as $result)
                       <option value="{{ $result->id }}">{{ $result->name }}</option>
                    @endforeach
                    </select>  
                </div>

                <div class="form-group">
                    <label>Konten</label>
                    <textarea class="form-control @error('konten') is-invalid @enderror" id="editor" name="konten" value="{{old('konten')}}"></textarea>
                    @error('konten')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Thumbnail</label>
                    <input type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar" value="{{old('gambar')}}">
                    @error('gambar')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

        <div class="form-group">
            <button class="btn btn-primary">Save Data</button>
        </div>
</form>

@endsection