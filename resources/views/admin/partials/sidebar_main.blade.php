<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-camera-retro fa-spin fa-lg"></i>
                </div>
                <div class="sidebar-brand-text mx-3">snapzone</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="/admin/index">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
              <li class="nav-item">
                <a class="nav-link collapsed" href="/admin/hero-list">
                    <i class="fas fa-window-maximize fa-lg"></i>
                    <span>Heros/Sliders</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-solid fa-users"></i>
                    <span>Users</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Berdasarkan Role</h6>
                        <a class="collapse-item" href="/admin/users/index">All</a>
                        @foreach($uniqueUsers as $role)
                        <a class="collapse-item" href="/admin/users/role/{{ $role->role}}">{{ $role->role }}</a>
                       @endforeach
                    </div>
                </div>
            </li>

             <li class="nav-item">
                <a class="nav-link collapsed" href="/admin/category-list">
                    <i class="fas fa-light fa-map"></i>
                    <span>Categories</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-solid fa-gift fa-2xl"></i>
                    <span>Products</span>
                </a>
               <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                     data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Berdasarkan Kategori</h6>
                        <a class="collapse-item" href="/admin/product-list">All</a>
                        @foreach($slug as $cat)
                            <a class="collapse-item" href="/admin/product-list/category/{{ $cat->slug }}">{{ $cat->name }}</a>
                        @endforeach
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
              <li class="nav-item">
                    <form action="/logout" method="POST" id="logout-form">
                        @csrf
                        <a class="nav-link collapsed" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt fa-xl"></i>
                            <span>Logout</span>
                        </a>
                    </form>
                </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>