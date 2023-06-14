@extends('admin/main')

@section('content')

<!-- Begin Page Content -->
  <div class="container-fluid">
    <small> Hai {{ auth()->user()->role }} {{ auth()->user()->name }} </small>
    <hr>
      @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if(session()->has('update'))
        <div class="alert alert-primary alert-dismissible fade show text-center" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('update') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if(session()->has('delete'))
        <div class="alert alert-primary alert-dismissible fade show text-center" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('delete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
         <div class="card-header py-3 d-flex justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary text-uppercase mb-1">List Pengguna</h6>
              <a href="/admin/users/create" class="btn btn-primary btn-sm ml-2"><i class="fas fa-solid fa-plus fa-lg"></i> User</a>
          </div>
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Photo</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Role</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $i = 1; @endphp
                        @foreach ($row as $data)
                        <tr>
                          <th>{{$i}}</th>
                          <td>
                            <img class="image" src="{{ asset('storage/'. $data['avatar']) }}" width="50px" height="50px" alt="{{ $data->name }}">
                          </td>
                          <td>{{ $data->name }} </td>
                          <td>{{ $data->email }} </td>
                          <td>{{ $data->role }} </td>
                          <td class="d-flex gap-2">
                          <a href="/admin/users/detail/{{ $data->id }}"><i class="fas fa-info-circle fa-lg"></i></a> 
                          @if(auth()->user()->role === 'admin')
                          ||
                          <a href="#" onclick="showEditConfirmation('{{ $data->name }}', {{ $data->id }})"><i class="fas fa-edit fa-lg" style="color: #f3c444;"></i></a> ||
                          <form action="/admin/users/delete/{{ $data->id }}" method="POST" id="deleteForm{{ $data->id }}">
                            @csrf
                            <a href="#" onclick="showConfirmation('{{ $data->name }}', {{ $data->id }})">
                                <i class="fas fa-trash fa-lg" style="color: #fb2323;"></i>
                            </a>
                          </form>
                          @endif
                          </td>
                        </tr>
                        @php $i++; @endphp
                        @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>

  </div>
  <!-- /.container-fluid -->
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

  <script>
      function showConfirmation(userName, userId) {
          Swal.fire({
              title: 'Konfirmasi',
              text: 'Yakin user ' + userName + ' dihapus?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya',
              cancelButtonText: 'Batal'
          }).then((result) => {
              if (result.isConfirmed) {
                  // Submit the form with the specified ID
                  document.getElementById('deleteForm' + userId).submit();
              }
          });
      }
  </script>

@endsection


