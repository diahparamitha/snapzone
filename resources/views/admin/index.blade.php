@extends('admin/main')

@section('content')

        <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <small> Hai {{ auth()->user()->role }} {{ auth()->user()->name }} </small>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 mx-3">
                                                Users</div>
                                            <div class="h5 mb-0 mx-3 font-weight-bold text-gray-800">{{ $users }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-thin fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1 mx-3">
                                                Categories</div>
                                            <div class="h5 mb-0 mx-3 font-weight-bold text-gray-800">{{ $categories }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-thin fa-images fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1 mx-3">Products
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 mx-3 font-weight-bold text-gray-800">{{ $products }}</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                           <i class="fas fa-thin fa-box-open fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1 mx-3">
                                                Sliders</div>
                                            <div class="h5 mb-0 mx-3 font-weight-bold text-gray-800">{{ $heros }}</div>
                                        </div>
                                        <div class="col-auto">
                                           <i class="fas fa-thin fa-forward fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                <hr>
                <div class="col-xl-10 col-md-6 mb-4">
                    <div class="card border-left-dark shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1 mx-3">
                                        About</div>
                                    <div class="mx-3" style="color: royalblue;">
                                    	<i>SnapZone: Artistry in Every Shot</i>
                                    </div>
                                    <div class="mx-3" style="text-align: justify;">
                                    	Mempersembahkan Karya Fotografi yang Memukau. Temukan koleksi unik kami yang mencakup potret alam, manusia, dan arsitektur yang menarik. Dari cetakan berkualitas tinggi hingga kanvas elegan, berikan sentuhan artistik pada ruang Anda dengan karya-karya kami. Jelajahi dunia fotografi di SnapZone.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection
