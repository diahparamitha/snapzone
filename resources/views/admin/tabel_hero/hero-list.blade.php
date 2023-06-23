@extends('admin/main')

<script>
    function updateStatus(heroId, status) {
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/update-status/' + heroId;
        form.style.display = 'none';

        var tokenInput = document.createElement('input');
        tokenInput.type = 'hidden';
        tokenInput.name = '_token';
        tokenInput.value = '{{ csrf_token() }}';
        form.appendChild(tokenInput);

        var statusInput = document.createElement('input');
        statusInput.type = 'hidden';
        statusInput.name = 'status';
        statusInput.value = status;
        form.appendChild(statusInput);

        document.body.appendChild(form);
        form.submit();
    }

    function updateDisetujui(heroId, accept) {
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/update-disetujui/' + heroId;
        form.style.display = 'none';

        var tokenInput = document.createElement('input');
        tokenInput.type = 'hidden';
        tokenInput.name = '_token';
        tokenInput.value = '{{ csrf_token() }}';
        form.appendChild(tokenInput);

        var acceptInput = document.createElement('input');
        acceptInput.type = 'hidden';
        acceptInput.name = 'accept';
        acceptInput.value = accept;
        form.appendChild(acceptInput);

        document.body.appendChild(form);
        form.submit();
    }
</script>

@section('content')

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
    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('delete') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


<div class="container font-weight-bold text-dark text-uppercase mb-1">
    <div class="d-flex justify-content-between align-items-center">
        <span>List Heroes</span>
        <a href="/admin/hero/create" class="btn btn-dark btn-sm ml-2"><i class="fas fa-solid fa-plus fa-lg"></i> Hero</a>
    </div>
</div>

<hr>

<div class="row">
    @foreach($heroes as $hero)
    <div class="col-md-6 mb-3">
        <div class="card">
            <img src="{{ asset('storage/image_hero/'. $hero->gambar) }}" alt="Icon" style="object-fit: cover; width: auto; height: 200px;">
            <div class="card-body" style="background-color: midnightblue; opacity: 0.9; color: whitesmoke;">
                <h5 class="card-title">{{ $hero->judul }}</h5>
                <p class="card-text">{{ $hero->deskripsi }}</p>
                <p class="text-muted">{{ $hero->user->name }} | {{ $hero->created_at->diffForHumans() }}</p>
                <div class="d-flex">
                    @if(auth()->user()->role === 'admin')
                    <a href="#" onclick="showEditConfirmation('{{ $hero->judul }}', {{ $hero->id }})"><i class="fas fa-edit fa-lg" style="color: #f3c444;"></i></a>
                <div class="ml-3">
                   <form action="/admin/delete-hero/{{ $hero->id }}" method="POST" id="deleteForm{{ $hero->id }}">
                    @csrf
                    <a href="#" onclick="showConfirmation('{{ $hero->judul }}', {{ $hero->id }})">
                        <i class="fas fa-trash fa-lg" style="color: #fb2323;"></i>
                    </a>
                    </form>
                </div>
                @endif
                <div class="d-flex ms-auto gap-2">
                    @if(auth()->user()->role === 'admin')
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButtonDisetujui{{$hero->id}}" data-bs-toggle="dropdown" aria-expanded="false">
                            @if($hero->disetujui === 1)
                                Disetujui
                            @else
                                Ditolak
                            @endif
                        </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonDisetujui{{$hero->id}}">
                            <li>
                                <a class="dropdown-item" href="#" onclick="updateDisetujui('{{ $hero->id }}', 1)">Disetujui</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="updateDisetujui('{{ $hero->id }}', 0)">Ditolak</a>
                            </li>
                        </ul>
                    </div>
                        @endif
                        
                    @if($hero->disetujui === 1)
                   <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButtonStatus{{$hero->id}}" data-bs-toggle="dropdown" aria-expanded="false">
                            @if($hero->status === 1)
                                Active
                            @else
                                Non-Active
                            @endif
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonStatus{{$hero->id}}">
                            <li>
                                <a class="dropdown-item" href="#" onclick="updateStatus('{{ $hero->id }}', 1)">Active</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="updateStatus('{{ $hero->id }}', 0)">Non-Active</a>
                            </li>
                        </ul>
                    </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<script>

    function showEditConfirmation(heroJudul, heroId) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Yakin ingin mengedit hero ' + heroJudul + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the edit page with the specified ID
                window.location.href = '/admin/hero/update/' + heroId;
            }
        });
    }

    function showConfirmation(heroJudul, heroId) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Yakin hero ' + heroJudul + ' dihapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form with the specified ID
                document.getElementById('deleteForm' + heroId).submit();
            }
        });
    }

</script>

@endsection
