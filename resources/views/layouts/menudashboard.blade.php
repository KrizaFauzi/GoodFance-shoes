<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
    <li class="nav-item">
      <a href="/admin" class="nav-link">
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
          <a href="/admin/kategori" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Kategori Produk</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('produk.index') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Add Produk</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/promo" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Promo</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/promoted_produk" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Promo Produk</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-shopping-cart"></i>
        <p>
          Transaksi
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Active Page</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Inactive Page</p>
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
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>
          Sign Out
        </p>
      </a>
    </li>
  </ul>
</nav>