@extends('landing/main')

@section('content')
 @if(session()->has('update'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('update') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-4">
			<img src="{{ asset ('storage/' . $user->avatar) }}" class="img-fluid" width="300px" height="500px" style="object-fit: cover;">
		</div>
		<div class="col-md-4">
			 <table class="table text-white">
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td>{{ $user->phone }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td>{{ $user->tgl_lahir }}</td>
                    </tr>
                    <tr>
                        <td>Umur</td>
                        <td>:</td>
                        <td>  
                        	@php
					        $tanggalLahir = new DateTime($user->tgl_lahir);
					        $sekarang = new DateTime();
					        $umur = $sekarang->diff($tanggalLahir)->y;
					        echo $umur . ' tahun';
					        @endphp
				    	</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>{{ $user->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $user->address }}</td>
                    </tr>
                    <td class="mt-3" style="border:none;">
                    	<button class="btn btn-dark"> <a href="/">Back</a></button>
                    	<a href="#" onclick="showEditConfirmation('{{ $user->id }}')" class="btn btn-dark">
						    <i class="fas fa-edit fa-lg" style="color: #f3c444;"></i>
						</a>
                    </td>
                </table>
		</div>
	</div>
</div>

 <script>
    function showEditConfirmation(userId) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Yakin ingin mengedit profil kamu?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the edit page with the specified ID
                    window.location.href = '/user/update/' + userId;
                }
            });
        }
  </script>

@endsection
