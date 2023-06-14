@extends('admin/main')

@section('content')

<hr>
	<div class="col-xl-10 col-md-6 mb-4">
        <div class="card border-left-dark shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="lead font-weight-bold text-dark text-uppercase mb-1">Update Product!</div>
                        <p> Produk yang mau di-update : {{ $product->name }}
                        <form action="/admin/update-product/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                        	@csrf
                        	 <div class="form mb-3">
                        		<label for="category_id" class="form-label">Kategori</label>
					            <select class="form-control @error('category_id') is-invalid @enderror" aria-label="category_id" id="category_id" name="category_id">
					              @foreach($categories as $category)
					                @if(old('category_id', $product->category_id) === $category->id)
					              <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
					                @else
					                <option value="{{ $category->id }}">{{ $category->name }}</option>
					                @endif
					              @endforeach
					            </select>
                        	</div>
                        	 <div class="form mb-3">
                        		<label for="name">Nama Product</label>
                        		<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="ex: Street View" required value="{{ old('name', $product->name) }}">
                        		 @error('name')
							        <div class="text-danger">{{ $message }}</div>
							     @enderror
                        	</div>
						  	 <div class="form mb-3">
                        		<label for="description">Deskripsi Product</label>
                        		<input type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="ex: Foto ini menggambarkan ..." required value="{{ old('description', $product->description) }}">
                        		@error('description')
							        <div class="text-danger">{{ $message }}</div>
							     @enderror
                        	</div>
							 <div class="form mb-3">
                        		<label for="price">Harga Product</label>
                        		<input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="ex: 1000" required value="{{ old('price', $product->price) }}">
                        		@error('price')
							        <div class="text-danger">{{ $message }}</div>
							     @enderror
                        	</div>
                        	 <div class="form mb-3">
                        		<label for="stok">Stok Product</label>
                        		<input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" id="stok" placeholder="ex: 10" required value="{{ old('stok', $product->stok) }}">
                        		@error('stok')
							        <div class="text-danger">{{ $message }}</div>
							     @enderror
                        	</div>
                        	<div class="form-group mb-3">
							  <label for="image">Gambar Product</label>
							  @if($product->image)
							    <img class="img-preview img-fluid mb-2" style="width: 100px; height: 100px; object-fit: cover; overflow: hidden;" 
							    src="{{ asset('storage/image_product/' . $product->image) }}" alt="Preview Gambar">
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
      const oldImage = "{{ asset('storage/image_product/' . $product->image) }}";
      imgPreview.style.display = 'block';
      imgPreview.src = oldImage;
    }
  }
</script>

@endsection