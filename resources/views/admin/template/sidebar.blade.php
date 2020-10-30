  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="{{ url('admin') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
           <li class="nav-item">
              <a href="{{ route('categories.index') }}" class="nav-link">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                Categories
              </p>
            </a>
          </li>
           <li class="nav-item">
              <a href="{{ route('products.index') }}" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Products
              </p>
            </a>
          </li>
           <li class="nav-item">
              <a href="{{ route('transactions.index') }}" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Transactions
              </p>
            </a>
          </li>
          <li class="nav-header">Sign Out</li>
          <li class="nav-item">
              <a href="{{ route('logout') }}" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

@push('scripts')
     <script type="text/javascript">
        $(function(){
            var url = window.location;
                $('ul.nav-sidebar a').filter(function() {
                return this.href == url;
            }).addClass('active');
                $('ul.nav-treeview a').filter(function() {
                return this.href == url;
            }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open') .prev('a').addClass('active');
        });
      </script>
  @endpush
