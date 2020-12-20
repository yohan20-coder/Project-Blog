@extends('template_backend.home')
@section('sub-judul','Edit Data')
@section('content')

        <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{old('judul')}} {{ $post->judul }}">
                    @error('judul')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" id="" class="form-control">
                    <option value="" holder>Pilih Kategori</option>
                    @foreach($category as $result)
                       <option value="{{ $result->id }}"
                       @if($post->category_id == $result->id)
                         selected
                       @endif
                       >{{ $result->name }}</option>
                    @endforeach
                    </select>                  
                </div>

                <div class="form-group">
                    <label>Tags</label>
                    <select name="tags[]" id="" class="form-control select2" multiple="">
                    @foreach($tags as $result)
                       <option value="{{ $result->id }}"
                       @foreach($post->tags as $value)
                            @if($result->id == $value->id)                  
                               selected
                            @endif
                       @endforeach
                       
                       >{{ $result->name }}</option>
                    @endforeach
                    </select>  
                </div>

                <div class="form-group">
                    <label>Konten</label>
                    <textarea class="form-control @error('konten') is-invalid @enderror" id="editor" name="konten" value="{{old('konten')}}">{{ $post->content }}</textarea>
                    @error('konten')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <img src="{{ asset($post->gambar) }}" class="img-fluid" width="100">
                </div>

                <div class="form-group">
                    <label>Thumbnail</label>
                    <input type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar" value="{{old('gambar')}}">
                    @error('gambar')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

        <div class="form-group">
            <button class="btn btn-primary">Update Data</button>
        </div>
</form>

@endsection