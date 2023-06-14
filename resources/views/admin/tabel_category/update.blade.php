@extends('admin/main')

@section('content')

<hr>
	<div class="col-xl-10 col-md-6 mb-4">
        <div class="card border-left-dark shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="lead font-weight-bold text-dark text-uppercase mb-1">Update Category!</div>
                        <p> Category yang mau di-update : {{ $category->name }}
                        <form action="/admin/category/update/{{ $category->id }}" method="POST" enctype="multipart/form-data">
                        	@csrf
                        	 <div class="form mb-3">
                        		<label for="name">Nama category</label>
                        		<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="ex: Street View" required value="{{ old('name', $category->name) }}">
                        		 @error('name')
							        <div class="text-danger">{{ $message }}</div>
							     @enderror
                        	</div>
						  	 <div class="form mb-3">
                        		<label for="slug">Slug category</label>
                        		<input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug" placeholder="ex: Foto ini menggambarkan ..." required value="{{ old('slug', $category->slug) }}">
                        		@error('slug')
							        <div class="text-danger">{{ $message }}</div>
							     @enderror
                        	</div>
                        		 <div class="form mb-3">
                        		<label for="description">Deskripsi category</label>
                        		<input type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="ex: Foto ini menggambarkan ..." required value="{{ old('description', $category->description) }}">
                        		@error('description')
							        <div class="text-danger">{{ $message }}</div>
							     @enderror
                        	</div>
                        	<div class="form-group mb-3">
							  <label for="image">Gambar Category</label>
							  @if($category->image)
							    <img class="img-preview img-fluid mb-2" style="width: 300px; height: 100px; object-fit: cover; overflow: hidden;" 
							    src="{{ asset('storage/image_category/' . $category->image) }}" alt="Preview Gambar">
							  @else
							    <img class="img-preview img-fluid mb-2" alt="Image Preview" style="width: 300px; height: 100px; object-fit: cover; display: none;">
							  @endif
							  <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImage()">
							  @error('image')
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
    const image = document.querySelector('#image');
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
      const oldImage = "{{ asset('storage/image_category/' . $category->image) }}";
      imgPreview.style.display = 'block';
      imgPreview.src = oldImage;
    }
  }
</script>

@endsection