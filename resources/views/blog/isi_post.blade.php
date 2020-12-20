@extends('template_blog.content')
	@section('isi')
</div>
		<!-- PAGE HEADER -->
	@foreach($data as $result)
		<div class="section-row">			
				<img src="{{ asset($result->gambar)}}" width="1156" style="height: 330px !important" class="img-thumbnail" alt="">
		</div>
	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-8">
					<div class="section-row">
						<div class="section-title">
							<h3 class="title">Postingan</h3>
						</div>
						<h1>{{$result->judul}}</h1>
						<p>{{!! $result->content !!}}</p>
					</div>
	@endforeach
	@endsection