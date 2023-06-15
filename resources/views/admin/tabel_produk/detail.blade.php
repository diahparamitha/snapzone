@extends('admin/main')

@section('content')

<hr>
<div class="row align-items-center justify-content-center">
  <div class="col-md-8 mb-3">
    <div class="card">
      <div class="ratio ratio-16x9">
        <img src="{{ asset('storage/image_product/'. $product['image']) }}" alt="Thumbnail" class="card-img-top">
      </div>
      <div class="card-body">
        <div class="d-flex align-items-center mb-3">
          <img src="{{ asset('storage/'. $product->user->avatar) }}" alt="Profile" class="rounded-circle me-2" width="40" height="40">
          <div>
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">Deskripsi: {{ $product->description }}</p>
            <p class="card-text">Harga: {{ $product->price }}</p>
            <p class="card-text">Stok: {{ $product->stok }}</p>
            <p class="card-text"><small class="text-muted">{{ $product->user->name }} | {{ $product->created_at->diffForHumans() }}</small></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
