@extends('admin/main')

@section('content')

<hr>
	<div class="col-xl-10 col-md-6 mb-4">
        <div class="card border-left-dark shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="lead font-weight-bold text-dark text-uppercase mb-1">Update Profil!</div>
                        <p> Profil yang mau di-update : {{ $user->name }}
                        <form action="/admin/users/update/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                        	@csrf
                        	 <div class="form mb-3">
                        		<label for="name">Nama</label>
                        		<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="ex: Diah Paramitha" required value="{{ old('name', $user->name) }}">
                        		 @error('name')
							        <div class="text-danger">{{ $message }}</div>
							     @enderror
                        	</div>
						  	 <div class="form mb-3">
                        		<label for="email">Email</label>
                        		<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="ex: diah@gmail.com" required value="{{ old('email', $user->email) }}">
                        		@error('email')
							        <div class="text-danger">{{ $message }}</div>
							     @enderror
                        	</div>
							 <div class="form mb-3">
                        		<label for="phone">Phone</label>
                        		<input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="ex: 0877xxxxxxxx" required value="{{ old('phone', $user->phone) }}">
                        		@error('phone')
							        <div class="text-danger">{{ $message }}</div>
							     @enderror
                        	</div>
                        	 <div class="form mb-3">
							    <label for="tgl_lahir">Tanggal Lahir</label>
							    <input type="date" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" required value="{{ old('tgl_lahir', $user->tgl_lahir) }}">
							    @error('tgl_lahir')
							        <div class="text-danger">{{ $message }}</div>
							    @enderror
							</div>
							<div class="form mb-3">
						    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
						    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
						        <option value="laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin) === 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
						        <option value="perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) === 'perempuan' ? 'selected' : '' }}>Perempuan</option>
						    </select>
						</div>

							 <div class="form mb-3">
                        		<label for="address">Address</label>
                        		<input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="ex: Jln. Kemerdekaan"  value="{{ old('address', $user->address) }}">
                        		 @error('address')
							        <div class="text-danger">{{ $message }}</div>
							     @enderror
                        	</div>
                        	<div class="form-group">
							    <label for="role">Role</label>
							    <select class="form-control" id="role" name="role">
							        <option disabled>Pilih Role</option>
							        @foreach ($uniqueUsers as $roleUser)
							            <option value="{{ $roleUser->role }}" {{ $user->role === $roleUser->role ? 'selected' : '' }}>
							                {{ $roleUser->role }}
							            </option>
							        @endforeach
							    </select>
							</div>

                        		<div class="form-group mb-3">
							  <label for="avatar">Photo</label>
							  @if($user->avatar)
							    <img class="img-preview img-fluid mb-2" style="width: 100px; height: 100px; object-fit: cover; overflow: hidden;" 
							    src="{{ asset('storage/' . $user->avatar) }}" alt="Preview Gambar">
							  @else
							    <img class="img-preview img-fluid mb-2" alt="Image Preview" style="width: 300px; height: 100px; object-fit: cover; display: none;">
							  @endif
							  <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" onchange="previewImage()">
							  @error('avatar')
							    <div class="text-danger">{{ $message }}</div>
							  @enderror
							</div>
						  <button type="submit" class="btn btn-primary float-right">Simpan</button>
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <script>
  function previewImage() {
    const image = document.querySelector('#avatar');
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
      const oldImage = "{{ asset('storage/avatars/' . $user->avatar) }}";
      imgPreview.style.display = 'block';
      imgPreview.src = oldImage;
    }
  }
</script>

@endsection