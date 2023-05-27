@extends('layouts/pengguna/main')

@section('content')

  <main id="main" data-aos="fade" data-aos-delay="1500">

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
      <div class="container-fluid">

        <div class="row gy-4 justify-content-center">
          @foreach ($products as $product)
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="gallery-item h-100">
              <img src="https://source.unsplash.com/1920x1440?{{ $product->category->name }}" class="img-fluid" alt="">
              <div class="gallery-links d-flex align-items-center justify-content-center">
                <a href="https://source.unsplash.com/1920x1440?{{ $product->category->name }}" title="Gallery 1" class="glightbox preview-link">
                  <i class="bi bi-arrows-angle-expand"></i></a>
                <a href="/product/detail/{{$product->id}}" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div>
          </div><!-- End Gallery Item -->
          @endforeach
        </div>

      </div>
    </section><!-- End Gallery Section -->

  </main><!-- End #main -->

@endsection