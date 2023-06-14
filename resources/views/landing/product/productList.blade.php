@extends('landing/main')

@section('content')

<div class="container-fluid">
  <h3 class="text-center">{{ $tag }}</h3>
  <h6 class="text-center">{{ $desc }}</h6>
  <hr>
</div>

<!-- Form Pencarian -->
<div class="container my-4">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <form action="/search" method="GET" class="d-flex">
        <input type="text" name="query" class="form-control me-2" placeholder="Cari nama produk">
        
        <select name="category" class="form-control me-2">
          <option value="">Semua Kategori</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
        
        <div class="input-group me-2">
          <input type="number" name="min_price" class="form-control" placeholder="Harga Min">
          <span class="input-group-text">-</span>
          <input type="number" name="max_price" class="form-control" placeholder="Harga Max">
        </div>
        
        <button type="submit" class="btn btn-primary">Cari</button>
      </form>
    </div>
  </div>
</div>

<div class="row gy-4 justify-content-center">
   @if($products->count() > 0)
  @foreach ($products as $product)
  @if($product->status === 'approved')
    <div class="col-xl-3 col-lg-4 col-md-6">
      <div class="gallery-item">
        <img src="{{ asset('storage/image_product/'. $product->image) }}" class="img-fluid" alt="{{ $product->name }}" style="width: 100%; height: 200px; object-fit: cover;">
        <div class="gallery-info mt-3">
          <h5 class="gallery-title">{{ $product->name }}</h5>
          <p class="gallery-price">Rp {{ $product->price }}
          <p class="text-muted">{{ $product->updated_at->diffForHumans() }}</p>
        </div>
        <div class="gallery-links d-flex align-items-center justify-content-center">
          <a href="{{ asset('image_product/'. $product->image) }}" title="{{ $product->name }}" class="glightbox preview-link">
            <i class="bi bi-arrows-angle-expand"></i></a>
          <a href="/product/detail/{{$product->id}}" class="details-link"><i class="bi bi-link-45deg"></i></a>
        </div>
      </div>
    </div><!-- End Gallery Item -->
    @endif
  @endforeach
  @else
    <p class="text-center">Produk yang Anda cari tidak ditemukan.</p>
  @endif
</div>



@endsection
