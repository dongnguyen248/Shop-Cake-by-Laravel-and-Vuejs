
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Administrator</title>
  <link rel="stylesheet" href="/css/app.css">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>


  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/images/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">LaraVue</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/images/profile.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          {{-- <a href="#" class="d-block">{{ Auth::user()->name }}</a> --}}
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <router-link to="/admin-dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt text-blue"></i>
              <p>
                Dashboard
              </p>
            </router-link>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog text-green"></i>
              <p>
                Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="padding-left:25px">
              <li class="nav-item">
                <router-link to="/admin-users" class="nav-link">
                  <i class="fas fa-users nav-icon text-yellow"></i>
                  <p>Users</p>
                </router-link>
              </li>
              
              <li class="nav-item">
                <router-link to="/admin-product" class="nav-link">
                  <i class="nav-icon fa fa-cubes text-teal"></i>
                  <p>
                    Product
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/admin-productType" class="nav-link">
                  <i class="nav-icon fas fa-anchor text-pink"></i>
                  <p>
                    ProductType
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/admin-productUom" class="nav-link">
                  <i class="nav-icon fas fa-balance-scale text-cyan"></i>
                  <p>
                    ProductUom
                  </p>
                </router-link>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <router-link to="/admin-profile" class="nav-link">
              <i class="nav-icon fas fa-user-circle text-orange"></i>
              <p>
                Profile
              </p>
            </router-link>
          </li>
          <li class="nav-item">
                <router-link to="./admin-developer" class="nav-link">
                  <i class="fas fa-cogs nav-icon "></i>
                  <p>Developer</p>
                </router-link>
              </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-power-off text-red"></i>
                <p>{{ __('Logout') }}</p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <router-view></router-view>
      <vue-progress-bar></vue-progress-bar>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->

<script src="/js/app.js"></script>
</body>
</html>
