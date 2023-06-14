@extends('admin/main')

@section('content')

<hr>
<div class="col-xl-10 col-md-6 mb-4">
    <div class="card border-left-dark shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="lead font-weight-bold text-dark text-uppercase mb-1">Update Hero!</div>
                    <p>Hero yang mau di-update: {{ $hero->judul }}</p>
                    <form action="/admin/hero/update/{{ $hero->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form mb-3">
                            <label for="judul">Judul Hero</label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" id="judul" placeholder="ex: Street View" required value="{{ old('judul', $hero->judul) }}">
                            @error('judul')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form mb-3">
                            <label for="deskripsi">Deskripsi hero</label>
                            <input type="text" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" placeholder="ex: Foto ini menggambarkan ..." required value="{{ old('deskripsi', $hero->deskripsi) }}">
                            @error('deskripsi')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                          <label for="gambar">Gambar Hero</label>
                          @if($hero->gambar)
                            <img class="img-preview img-fluid mb-2" style="width: 300px; height: 100px; object-fit: cover; overflow: hidden;" 
                            src="{{ asset('storage/image_hero/' . $hero->gambar) }}" alt="Preview Gambar">
                          @else
                            <img class="img-preview img-fluid mb-2" alt="Image Preview" style="width: 300px; height: 100px; object-fit: cover; display: none;">
                          @endif
                          <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" onchange="previewImage()">
                          @error('gambar')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

 <script>
  function previewImage() {
    const image = document.querySelector('#gambar');
    const imgPreview = document.querySelector('.img-preview');

    // Menghapus gambar pratinjau sebelumnya
    imgPreview.src = "";
    imgPreview.style.display = 'none';

    if (image.files && image.files[0]) {
      const reader = new FileReader();

      reader.onload = function(oFREvent) {
        imgPreview.style.display = 'block';
        imgPreview.src = oFREvent.target.result;
      }

      reader.readAsDataURL(image.files[0]);
    } else {
      // Menampilkan gambar lama jika ada
      const oldImage = "{{ asset('storage/image/hero/' . $hero->gambar) }}";
      imgPreview.style.display = 'block';
      imgPreview.src = oldImage;
    }
  }
</script>

@endsection
