@extends('landing/main')

@section('content')

 @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
<div class="container">
	<h1 class="text-center">Daftar</h1>
	<hr>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="/user/create" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                         <div class="form mb-3">
                        		<label for="name">Nama</label>
                        		<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="ex: Diah Paramitha" required value="{{ old('name') }}">
                        		 @error('name')
							        <div class="text-danger">{{ $message }}</div>
							     @enderror
                        	</div>
						  	 <div class="form mb-3">
                        		<label for="email">Email</label>
                        		<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="ex: diah@gmail.com" required value="{{ old('email') }}">
                        		@error('email')
							        <div class="text-danger">{{ $message }}</div>
							     @enderror
                        	</div>
                    </div>
                    <div class="col-md-6">
                    	 <div class="form mb-3">
                        		<label for="phone">Phone</label>
                        		<input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="ex: 0877xxxxxxxx" required value="{{ old('phone') }}">
                        		@error('phone')
							        <div class="text-danger">{{ $message }}</div>
							     @enderror
                        	</div>

							 <div class="form mb-3">
                        		<label for="address">Address</label>
                        		<input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="ex: Jln. Kemerdekaan"  value="{{ old('address') }}">
                        		 @error('address')
							        <div class="text-danger">{{ $message }}</div>
							     @enderror
                        	</div>

                        	 <div class="form mb-3">
                        		<label for="password">Password</label>
                        		<input type="text" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="ex: Password123"  value="{{ old('password') }}">
                        		 @error('password')
							        <div class="text-danger">{{ $message }}</div>
							     @enderror
                        	</div>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark btn-outline-success float-end mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection
