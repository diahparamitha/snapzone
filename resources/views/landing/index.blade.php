@extends('landing/main')

@section('content')

<div class="container-fluid">
  <h3 class="text-center">L A T E S T</h3>
  <h6 class="text-center">Jelajahi dunia melalui poto</h6>
  <hr>
</div>
<div class="row gy-4 justify-content-center">
  @foreach ($products as $product)
    <div class="col-xl-3 col-lg-4 col-md-6">
      <div class="gallery-item h-100">
        <img src="{{ asset('storage/image_product/'. $product->image) }}" class="img-fluid" alt="{{ $product->name }}" style="width: 100%; height: 200px; object-fit: cover;">
        <div class="gallery-links d-flex align-items-center justify-content-center">
          <a href="{{ asset('image_product/'. $product->image) }}" title="{{ $product->name }}" class="glightbox preview-link">
            <i class="bi bi-arrows-angle-expand"></i></a>
          <a href="/product/detail/{{$product->id}}" class="details-link"><i class="bi bi-link-45deg"></i></a>
        </div>
      </div>
    </div><!-- End Gallery Item -->
  @endforeach
</div>

@endsection