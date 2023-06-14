<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    @php
      $firstActiveIndex = -1; // Indeks pertama gambar aktif setelah gambar pertama non-aktif
    @endphp
    @foreach ($hero as $index => $item)
      @if ($item->status === 1)
        @if ($firstActiveIndex === -1)
          @php
            $firstActiveIndex = $index; // Setel indeks pertama gambar aktif
          @endphp
        @endif
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $index - $firstActiveIndex }}" {{ ($index === $firstActiveIndex) ? 'class=active' : '' }} aria-label="Slide {{ $index+1 }}"></button>
      @endif
    @endforeach
  </div>
  <div class="carousel-inner">
    @foreach ($hero as $index => $item)
      @if ($item->status === 1)
        <div class="carousel-item {{ ($index === $firstActiveIndex) ? 'active' : '' }}">
          <img src="{{ asset('storage/image_hero/'. $item->gambar) }}" style="object-fit: cover; width: 1200px; height: 350px;">
          <div class="carousel-caption d-none d-md-block">
            <h5>{{ $item->judul }}</h5>
            <h6>{{ $item->deskripsi }}</h6>
          </div>
        </div>
      @endif
    @endforeach
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
