  <!-- ======= Header ======= -->
  
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="/" class="logo d-flex align-items-center  me-auto me-lg-0">
        <i class="fas fa-camera-retro fa-spin fa-2lg"></i>
        <h1>Snapzone</h1>
      </a>
      
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="/"{{ Request::is('/') ? ' class=active' : '' }}>Home</a></li>
          <li><a href="/product"{{ Request::is('product') ? ' class=active' : '' }}>Product</a></li>
          <li class="dropdown{{ Request::is('categories/*') ? ' active' : '' }}">
            <a href="#"><span>Category</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              @foreach ($categories as $category)
              <li><a href="/product/categories/{{ $category->slug }}"{{ Request::is('categories/'.$category->slug) ? ' class=active' : '' }}>{{ $category->name }}</a></li>
              @endforeach
            </ul>
          </li>
          @if(!Auth::check())
              <li><a href="/login">Login</a></li>
          @endif

          @if(Auth::check())
          <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="/logout" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
          @endif
        </ul>
      </nav><!-- .navbar -->


       <div class="header-social-links">
         @auth
            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'staff' )
                <a href="/admin/index" class="twitter"><i class="bi bi-person-circle"></i> Dashboard </a>
            @elseif (auth()->user()->role == 'pengguna')
                <a href="/user/detail/{{ auth()->user()->id}}" class="twitter"><i class="bi bi-person-circle"></i> Profile </a>
            @endif
        @endauth
      </div>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  <!-- End Header -->