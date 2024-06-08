<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
<script src="https://kit.fontawesome.com/bc8e231302.js" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
  .main-sidebar {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 999999999;
    transition: all 0.5s;
    height: 100%;
    width: 250px;
  }
</style>

<aside class="main-sidebar elevation-4" style = "position: fixed; height: 100%;">
  {{-- <a href="/home" style="vertical-align: middle; color:white"> --}}
    <div style="padding-top: 9.25px; padding-left:10px; overflow: auto; background: rgba(255, 255, 255, 1)">
    <a href="/home" style="text-decoration: none;">
      <img src="{{ asset('img/logo.png') }}" alt="logo"
        style="height: 40px; display:inline-block; border-radius: 5px;">
      <h6
        style="margin:0; display:inline-block; vertical-align: middle; color:black; font-family:verdana; font-size:13px">
        Kedai Basikal<br>Budget &
        Customized
      </h6>
    </a>
  </div>
  {{-- </a> --}}

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel d-flex"
      style="margin-bottom: 0px;padding-top:45px; padding-bottom: 10px; display: flex; flex-direction: column; ">
      <div class="image" style="padding-left:0;">
        <img src="{{ asset('img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image"
          style="display: block;
        margin-left: auto;
        margin-right: auto;
        width: 40%;">
      </div>
      <div class="info" style="padding-left: 0; pdding-right:0">
        <a href="#" class="d-block" style="text-decoration: none; color:black; text-align: center ">
          {{ Auth::user()->name }}
        </a>
      </div>
    </div>
    <hr>


    <!-- SidebarSearch Form -->
    {{-- <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div> --}}

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

        <li class="nav-item">
          <a href="{{ url('/home') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        @can(['user-list', 'role-list'])
          <li class="nav-item roles-permission">
            <a href="#" class="nav-link" onclick="openMenuRolesPermission();">
              <i class="nav-icon fa-solid fa-key"></i>
              <p>
                Roles/Permission
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview" style="height: 90px">
              {{-- @can('user-list') --}}
              <li class="nav-item" style = "position:relative; left:15px;">
                <a href="{{ url('/user') }}" class="nav-link">
                  <i class="nav-icon fa-solid fa-user"></i>
                  <p>Users</p>
                </a>
              </li>
              {{-- @endcan --}}
              {{-- @can('role-list') --}}
              <li class="nav-item" style = "position:relative; left:15px;">
                <a href="{{ url('/roleAndPermission') }}" class="nav-link">
                  <i class="nav-icon fa-solid fa-address-card"></i>
                  <p>Roles</p>
                </a>
              </li>
              {{-- @endcan --}}
              {{-- @can('permission-list') --}}
              {{-- <li class="nav-item" style = "position:relative; left:15px;">
              <a href="{{ url('/permissions') }}" class="nav-link">
                <i class="nav-icon fa-solid fa-fingerprint"></i>
                <p>Permission</p>
              </a>
              <br>
              </li> --}}
              {{-- @endcan --}}
            </ul>
          </li>
        @endcan
        @can('customer-list')
        <li class="nav-item">
          <a href="{{ url('/customer') }}" class="nav-link">
            <i class="nav-icon fa-solid bi bi-people-fill"></i>
            <p>Customer Info</p>
          </a>
        </li>
        @endcan
        @can('inventory-list')
        <li class="nav-item">
          <a href="{{ url('/inventory') }}" class="nav-link">
            <i class="nav-icon fa-solid bi-bicycle"></i>
            <p>
              Inventory
            </p>
          </a>
        </li>
        @endcan
        @can('purchaseRecord-list')
        <li class="nav-item">
          <a href="{{ url('/purchaseRecord') }}" class="nav-link">
            <i class="nav-icon fa-solid bi bi-bag-check-fill"></i>
            <p>Purchase Records</p>
          </a>
        </li>
        @endcan
        @can('supplyRecord-list')
        <li class="nav-item">
          <a href="{{ url('/supplyRecord') }}" class="nav-link">
            <i class="nav-icon fa-solid fa-book"></i>
            <p>
              Supply Records
            </p>
          </a>
        </li>
        @endcan
        @can('supplier-list')
        <li class="nav-item">
          <a href="{{ url('/supplier') }}" class="nav-link">
            <i class="nav-icon fa-solid bi bi-box-seam"></i>
            <p>Supplier</p>
          </a>
        </li>
        @endcan

      </ul>

    </nav>

    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<script>
  let isMenuRolesPermissionAdded = false;

  function openMenuRolesPermission() {
    const menuRolesPermission = document.querySelector(".roles-permission");
    if (!isMenuRolesPermissionAdded) {
      menuRolesPermission.classList.add("menu-open", "menu-is-opening");
      isMenuRolesPermissionAdded = true;
    } else {
      menuRolesPermission.classList.remove("menu-open", "menu-is-opening");
      isMenuRolesPermissionAdded = false;
    }
  }
</script>
