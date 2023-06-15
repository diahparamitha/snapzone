@extends('admin/main')

@section('content')

<hr>
<div class="col-xl-10 col-md-6 mb-4">
    <div class="card border-left-dark shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="lead font-weight-bold text-dark text-uppercase mb-1">Kategori Baru!</div>
                    <form action="/admin/category/create" method="POST" enctype="multipart/form-data">
                    	@csrf
                    	 <div class="form mb-3">
                    		<label for="name">Nama Kategori</label>
                    		<input type="text" name="name" class="form-control" id="name" placeholder="ex: Food" required value="{{ old('name') }}">
                    		 @error('name')
						        <div class="text-danger">{{ $message }}</div>
						     @enderror
                    	</div>
					  	 <div class="form mb-3">
                    		<label for="description">Deskripsi Kategori</label>
                    		<input type="text" name="description" class="form-control" id="description" placeholder="ex: Kategori Food ..." required value="{{ old('description') }}">
                    		@error('description')
						        <div class="text-danger">{{ $message }}</div>
						     @enderror
                    	</div>
						 <div class="form mb-3">
                    		<label for="slug">Slug Kategori</label>
                    		<input type="text" name="slug" class="form-control" id="slug" placeholder="ex: kategori-food" required value="{{ old('slug') }}">
                    		@error('slug')
						        <div class="text-danger">{{ $message }}</div>
						     @enderror
                    	</div>
                    	 <div class="form mb-3">
						    <label for="image">Gambar Kategori</label>
						    <input type="file" name="image" class="form-control" id="image" required>
						</div>
					  <button type="submit" class="btn btn-primary float-right">Submit</button>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection