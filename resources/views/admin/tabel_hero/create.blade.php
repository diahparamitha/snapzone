@extends('admin/main')

@section('content')

<hr>
	<div class="col-xl-10 col-md-6 mb-4">
        <div class="card border-left-dark shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="lead font-weight-bold text-dark text-uppercase mb-1">Hero Baru!</div>
                        <form action="/admin/hero/create" method="POST" enctype="multipart/form-data">
                        	@csrf
                        	 <div class="form mb-3">
                        		<label for="judul">Judul Hero</label>
                        		<input type="text" name="judul" class="form-control" id="judul" placeholder="ex: Food" required value="{{ old('judul') }}">
                        		 @error('judul')
							        <div class="text-danger">{{ $message }}</div>
							     @enderror
                        	</div>
						  	 <div class="form mb-3">
                        		<label for="deskripsi">Deskripsi Hero</label>
                        		<input type="text" name="deskripsi" class="form-control" id="deskripsi" placeholder="ex: Food adalah hero ..." required value="{{ old('deskripsi') }}">
                        		@error('deskripsi')
							        <div class="text-danger">{{ $message }}</div>
							     @enderror
                        	</div>
                        	 <div class="form mb-3">
							    <label for="gambar">Gambar Hero</label>
							    <input type="file" name="gambar" class="form-control" id="gambar" required>
							</div>
						  <button type="submit" class="btn btn-primary float-right">Submit</button>
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection