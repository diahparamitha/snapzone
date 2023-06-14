@extends('admin/main')

@section('content')

 <!-- Content Row -->
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

    @if(session()->has('delete'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('delete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

     @if(session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
      
 <div class="container font-weight-bold text-warning text-uppercase mb-1">
 	<div class="d-flex justify-content-between align-items-center">
 		<span>List Product</span>
	 	<a href="/admin/product/create" class="btn btn-warning btn-sm ml-2"><i class="fas fa-solid fa-plus fa-lg"></i> Product</a>
 	</div>
 </div>
 <hr>
<div class="row">
    @foreach($products as $product)
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card">
                <img src="{{ asset('storage/image_product/'. $product['image']) }}" class="card-img-top" alt="{{ $product->name }}" style="width: auto; height: 200px; overflow: hidden;">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">Price: {{ $product->price }}</p>
                    <div class="d-flex gap-2 mb-3">
                        <a href="/admin/detail-product/{{ $product->id }}" class="btn btn-primary"><i class="fas fa-info-circle"></i></a>
                        @if(auth()->user()->role === 'admin')
                        <a href="#" onclick="showEditConfirmation('{{ $product->name }}', {{ $product->id }})" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="/admin/delete-product/{{ $product->id }}" method="POST" id="deleteForm{{ $product->id }}">
                            @csrf
                            <a href="#" onclick="showConfirmation('{{ $product->name }}', {{ $product->id }})" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        </form>
                        @endif
                    </div>
                    @if(auth()->user()->role === 'admin')
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="statusDropdown{{ $product->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ ucfirst($product->status) }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="statusDropdown{{ $product->id }}">
                            @foreach(['pending', 'approved', 'rejected'] as $status)
                                <a class="dropdown-item" href="/update-product-status/{{ $product->id }}/{{ $status }}">{{ ucfirst($status) }}</a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>


<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<script>
function showEditConfirmation(productName, productId) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Yakin ingin mengedit product ' + productName + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the edit page with the specified ID
                window.location.href = '/admin/update-product/' + productId;
            }
        });
    }
</script>


<script>
    function showConfirmation(productName, productId) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Yakin product ' + productName + ' dihapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form with the specified ID
                document.getElementById('deleteForm' + productId).submit();
            }
        });
    }
</script>


@endsection
