@extends('admin/main')

@section('content')

<hr>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('storage/' . $user->avatar )}}" class="profile-picture" alt="Foto Profil">
                <small>dibuat {{ $user->created_at->diffForHumans() }}</small>
            </div>
            <div class="col-md-8">
                <h5 class="card-title">Detail Profil {{ $user->name }}</h5>
                <table class="table">
                    <tr>
                        <td>Name</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{ $user->phone }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>{{ $user->tgl_lahir }}</td>
                    </tr>
                    <tr>
                        <td>Umur</td>
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
                        <td>{{ $user->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>{{ $user->address }}</td>
                    </tr>
                    <tr>
                        <td>Role</td>
                        <td>{{ $user->role }}</td>
                    </tr>
                    <td>
                         <a href="#" onclick="showEditConfirmation('{{ $user->name }}', {{ $user->id }})"><i class="fas fa-edit fa-lg" style="color: #f3c444;"></i></a>
                    </td>
                </table>
            </div>
        </div>
    </div>
</div>

  <script>
    function showEditConfirmation(userName, userId) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Yakin ingin mengedit user ' + userName + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the edit page with the specified ID
                    window.location.href = '/admin/users/update/' + userId;
                }
            });
        }
  </script>

@endsection