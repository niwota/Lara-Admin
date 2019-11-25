<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{user_avatar(auth()->user()->avatar)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->nickname}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @foreach (get_menu() as $item)
            @if(empty($item['children']))
                @can($item['permission'])
                <li class="nav-item">
                    <a href="{{route($item['uri'])}}" class="nav-link">
                      <i class="nav-icon {{$item['icon']??''}}"></i>
                      <p>{{$item['name']}}</p>
                    </a>
                </li>
                @endcan
            @else
              @can($item['permission'])
              <li class="nav-item has-treeview">
                  <a href="#" class="nav-link p-menu">
                      <i class="nav-icon {{$item['icon']??''}}"></i>
                      <p>{{$item['name']}}<i class="right fas fa-angle-left"></i></p>
                  </a>
                  <ul class="nav nav-treeview">
                  @foreach ($item['children'] as $child)
                      @can($child['permission'])
                      <li class="nav-item">
                          <a href="{{route($child['uri'])}}" class="nav-link">
                          <i class="{{$child['icon']}} nav-icon"></i>
                          <p>{{$child['name']}}</p>
                          </a>
                      </li>
                      @endcan
                  @endforeach
                  </ul>
              </li>
              @endcan
            @endif
          @endforeach
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>