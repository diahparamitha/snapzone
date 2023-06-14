@extends('landing/main')

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<img src="{{ asset ('storage/image_product/' . $product->image) }}" width="auto" height="350px">
		</div>
		<div class="col-md-4">
			<h1> {{ $product->name }}</h1>
			<p>Category : {{ $product->category->name }}</p>
			<p>Deskription : {{ $product->description }}</p>
			<p>Price : {{ $product->price }}</p>
			<p>Stock : {{ $product->stok }}</p>
			<p>Created by : {{ $product->user->name }}</p>
			<p class="text-muted"> Last Update : {{ $product->updated_at->diffForHumans()}}</p>
			<button class="btn btn-dark"> <a href="/product">Back</a></button>
			<button class="btn btn-dark"><a href="https://api.whatsapp.com/send?phone=6287771842546">Beli Sekarang</a></button>
		</div>
	</div>
</div>
@endsection
