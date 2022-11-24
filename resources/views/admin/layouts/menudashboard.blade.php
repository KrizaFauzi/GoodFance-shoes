<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
    <li class="nav-item">
      <a href="/admin" class="nav-link">
        <p>
          Home
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('about.create') }}" class="nav-link">
        <p>
          About
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('kategori.index') }}" class="nav-link">
        <p>
          Kategori
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('image.index') }}" class="nav-link">
        <p>
          Image
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('slideshow.index') }}" class="nav-link">
        <p>
          Slideshow
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('event.index') }}" class="nav-link">
        <p>
          Event
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('order.adminOrder') }}" class="nav-link">
        <p>
          Order
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('order.ekspedisi') }}" class="nav-link">
        <p>
          Barang tiba
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('logout') }}"
      class="nav-link"
      onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">
        <p>Log Out</p>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </li>
  </ul>
</nav>