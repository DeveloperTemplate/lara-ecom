  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: #272829 !important">
      <!-- Brand Logo -->
      <a href="{{ url('admin/dashboard') }}" class="brand-link text-center">
          {{-- <img src="{{ url('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
          <span class="brand-text font-weight-light text-uppercase">ECOM</span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3  text-center">
              {{-- <div class="image">
          <img src="{{ url('images/admin.png') }}" class="img-circle elevation-2" alt="User Image">
        </div> --}}
        <div class="info text-center">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
          </div>
          <!-- SidebarSearch Form -->
          {{-- <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                      aria-label="Search">
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
               <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}" aria-current="page" href="{{ url('admin/dashboard') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
               </li>
               <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) == 'order' ? 'active' : '' }}" aria-current="page"
                    href="{{ route('order.index') }}">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    <p>Order</p>
                </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::segment(2) == 'user' ? 'active' : '' }}" aria-current="page"
                        href="{{ url('admin/user') }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>User</p>
                    </a>
                </li>
               <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) == 'category' ? 'active' : '' }}" aria-current="page"  href="{{ route('category.index') }}">
                    <i class="nav-icon fas fa-feather"></i>
                    <p>Category</p>
                </a>
               </li>
               <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) == 'sub-category' ? 'active' : '' }}" aria-current="page"  href="{{ route('sub-category.index') }}">
                    <i class="nav-icon fas fa-baby"></i>
                    <p>Sub Category</p>
                </a>
               </li>
               <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) == 'child-category' ? 'active' : '' }}" aria-current="page" href="{{ route('child-category.index') }}">
                    <i class="nav-icon fas fa-child"></i>
                    <p>Child Category</p>
                </a>
               </li>
               <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) == 'product' ? 'active' : '' }}" aria-current="page"  href="{{ route('product.index') }}">
                    <i class="nav-icon fas fa-sitemap"></i>
                    <p>Product</p>
                </a>
               </li>
               <li class="nav-item">
                <a class="nav-link {{ Request::segment(2) == 'banner' ? 'active' : '' }}" aria-current="page"  href="{{ route('banner.index') }}">
                    <i class="nav-icon fas fa-sliders-h"></i>
                    <p>Banner</p>
                </a>
               </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::segment(2) == 'notification' ? 'active' : '' }}"
                        aria-current="page" href="{{ url('admin/notification') }}">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>Push Notification</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::segment(2) == 'setting' ? 'active' : '' }}" aria-current="page"
                        href="{{ route('setting.index') }}">
                        <i class="nav-icon fas fa-hammer"></i>
                        <p>Setting</p>
                    </a>
                    </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
