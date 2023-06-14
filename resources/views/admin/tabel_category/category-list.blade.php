@extends('admin/main')

@section('content')

<div class="container">
    <div class="col-xl-12 col-md-6 mb-4">
        <hr>
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session()->has('update'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('update') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="lead font-weight-bold text-success text-uppercase mb-1">List Category</div>
                            <a href="/admin/category/create" class="btn btn-success btn-sm ml-2"><i class="fas fa-solid fa-plus fa-lg"></i> Category</a>
                        </div>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i = 1; @endphp
                                            @foreach ($categories as $category)
                                            <tr>
                                                <th>{{ $i }}</th>
                                                <td>
                                                	<img class="image" src="{{ asset('storage/image_category/'. $category['image']) }}" width="100px" alt="{{ $category->slug }}">
                                                </td>
                                                <td>{{ $category->name }}</td>
                                                <td class="d-flex gap-2">
                                                    <a href="/admin/category/detail/{{ $category->id }}"><i class="fas fa-info-circle fa-lg"></i></a> 
                                                    @if(auth()->user()->role === 'admin')
                                                    ||
                                                    <a href="#" onclick="showEditConfirmation('{{ $category->name }}', {{ $category->id }})"><i class="fas fa-edit fa-lg" style="color: #f3c444;"></i></a> ||
                                                    <form action="/admin/category/delete/{{ $category->id }}" method="POST" id="deleteForm{{ $category->id }}">
                                                        @csrf
                                                        <a href="#" onclick="showConfirmation('{{ $category->name }}', {{ $category->id }})">
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
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showEditConfirmation(categoryName, categoryId) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Yakin ingin mengedit kategori ' + categoryName + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the edit page with the specified ID
                window.location.href = '/admin/category/update/' + categoryId;
            }
        });
    }
</script>

<script>
    function showConfirmation(categoryName, categoryId) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Yakin kategori ' + categoryName + ' dihapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form with the specified ID
                document.getElementById('deleteForm' + categoryId).submit();
            }
        });
    }
</script>

@endsection
