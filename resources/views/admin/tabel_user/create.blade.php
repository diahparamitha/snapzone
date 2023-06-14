@extends('admin/main')

@section('content')

<small> Hai {{ auth()->user()->role }} {{ auth()->user()->name }} </small>
<hr>

@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
@endif

	<div class="col-xl-10 col-md-6 mb-4">
        <div class="card border-left-dark shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="lead font-weight-bold text-dark text-uppercase mb-1">User Baru!</div>
                        <form action="/admin/users/create" method="POST" enctype="multipart/form-data">
                        	@csrf
                        	 <div class="form mb-3">
                        		<label for="name">Nama</label>
                        		<input type="text" name="name" class="form-control" id="name" placeholder="ex: Diah Paramitha" required value="{{ old('name') }}">
                        		 @error('name')
							        <div class="text-danger">{{ $message }}</div>
							     @enderror
                        	</div>
						  	 <div class="form mb-3">
                        		<label for="email">Email</label>
                        		<input type="email" name="email" class="form-control" id="email" placeholder="ex: diah@gmail.com" required value="{{ old('email') }}">
                        		@error('email')
							        <div class="text-danger">{{ $message }}</div>
							     @enderror
                        	</div>
							 <div class="form mb-3">
                        		<label for="phone">Phone</label>
                        		<input type="number" name="phone" class="form-control" id="phone" placeholder="ex: 0877xxxxxxxx" required value="{{ old('phone') }}">
                        		@error('phone')
							        <div class="text-danger">{{ $message }}</div>
							     @enderror
                        	</div>
                        	 <div class="form mb-3">
                        		<label for="address">Address</label>
                        		<input type="text" name="address" class="form-control" id="address" placeholder="ex: Jalan Universitas" required value="{{ old('address') }}">
                        		@error('address')
							        <div class="text-danger">{{ $message }}</div>
							     @enderror
                        	</div>
                        	 <div class="form mb-3">
                        		<label for="password">Password</label>
                        		<input type="text" name="password" class="form-control" id="password" placeholder="ex: Password123" required value="{{ old('password') }}">
                        		@error('password')
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

@endsection