@extends('admin/main')

@section('content')

<hr>
<div class="card">
  <img src="{{ asset('storage/image_category/'. $category['image']) }}" alt="Thumbnail" class="card-img-top" style="width: auto; height:300px; object-fit:cover;">
  <div class="card-body">
    <div class="d-flex align-items-center mb-3">
      <img src="{{ asset('storage/'. $category->user->avatar) }}" alt="Profile" class="rounded-circle me-2" width="40px" height="40px">
      <div>
        <h5 class="card-title">{{ $category->name }}</h5>
        <p class="card-text">Slug : {{ $category->slug }}</p>
        <p class="card-text">Description : {{ $category->description }}</p>
        <p class="card-text"><small class="text-muted">{{ $category->user->name }} | {{ $category->created_at->diffForHumans() }}</small></p>
      </div>
    </div>
  </div>
</div>

@endsection