<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
    <li class="nav-item">
      <a href="/seller" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-folder-open"></i>
        <p>
          Produk
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('produk.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Add Produk</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('promo.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Promo</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('promoted_produk.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Promo Produk</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-calendar"></i>
        <p>
          Event
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('Event.even') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Event</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('seller/events') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Event diikuti</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-shopping-cart"></i>
        <p>
          Order
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('order.orderan') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Dikirim</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('order.orderanold') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Telah diterima pembeli</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item has-treeview">
      <a href="" class="nav-link">
        <i class="nav-icon fas fa-list"></i>
        <p>
          Laporan
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="/admin/laporan" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Penjualan</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a href="{{ route('logout') }}"
      class="nav-link"
      onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Log Out</p>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </li>
  </ul>
</nav>