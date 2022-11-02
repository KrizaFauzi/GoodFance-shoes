<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-white bg-white text-white shadow-none py-2">
  <!-- Container wrapper -->
  <div class="container-fluid" style="margin-left: 55px; margin-right: 50px;">
    <div class="d-flex align-items-center justify-content-start">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-lg-0 fw-bold" href="/">
        GoodFance
      </a>
    </div>

      <!-- Search -->
      <form action="/search" method="POST" class="mx-3" style="display: inline-block; width:100%;">
        @csrf
        <div class="input-group ms-2">
          <input name="search" style="height: 40px; border-radius: 30px 0 0 30px;" type="text" class="form-control" placeholder="Search">
          <button style="height: 40px; border-radius: 0 30px 30px 0;" class="input-group-text bg-dark text-white border-0" type="submit">
            <span>
              <i class="fa fa-search"></i>
            </span>
          </button>
        </div>
      </form>
      <!-- Search -->

    <!-- Right elements -->
    <div class="d-flex align-items-center justify-content-end">

      @guest
      <div class="btn-group shadow-none mt-2 mt-lg-0 mt-md-0 mt-xl-0">
        <a style="width: 100px; font-size: 14px;" href="{{ route('login') }}" class="btn btn-outline-dark align-self-center mx-2 mx-lg-3 mx-md-2 mx-xl-3 rounded fw-semibold">Sign in</a>
        <a style="width: 100px; font-size: 14px;" href="{{ route('register') }}" class="btn btn-dark align-self-center me-2 rounded fw-semibold">Sign up</a>
      </div>
      @endguest

      <!-- Account -->
      @auth
      <div class="dropdown hover ms-3" style="z-index: 2;">
        <a class="bg-transparent text-black" href="#">Hello, {{ Auth::user()->name }} <br><span class="fw-bold">Account Settings</span>
          <i class="fa-solid fa-caret-down"></i>
        </a>
        <ul class="menu-dropdown" style="width: 190px;">
          <li><a href="{{ route('profile.edit') }}">Account</a></li>
          <li><a style="padding-top: 2.5px;" href="/admin">Become a seller</a></li>
          <li>
            <a style="padding-top: 2.5px; padding-bottom: 7px;" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </li>
        </ul>
      </div>
      @endauth
      <!-- Cart -->
      <button type="button" class="btn btn-transparent align-self-center shadow-none mt-2 mt-lg-0 mt-md-0 mt-xl-0">
        <a class="text-dark fs-5" href="/cart">
          <i class="fas fa-shopping-cart"></i>
        </a>
      </button>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->