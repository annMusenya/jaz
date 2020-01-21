<header class="header">
  <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow">
    <a href="#" onclick="return false" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead">
      <i class="fas fa-align-left"></i>
    </a>
      <a href="#" class="navbar-brand font-weight-bold text-uppercase text-base">www.custom-written.com</a>
      <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
        <li class="nav-item">
        </li>
          @if ($userDetails)
          <li class="nav-item dropdown mr-3">
              <a id="notifications" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-gray-400 px-1">
                <i class="fa fa-bell text-muted"></i>
                <!-- <span class="notification-icon"></span> -->
              </a>
              @include ('layouts.partials.notifications')
          </li>
          <li class="nav-item dropdown ml-auto">
              <a id="userInfo" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                <img src="{{asset('img/user.svg')}}" class="img-fluid rounded-circle shadow">
              </a>
              <div aria-labelledby="userInfo" class="dropdown-menu">
                    <a href="/writer/my-account" class="dropdown-item">My Account</a>
                    <div class="dropdown-divider"></div>
                    <a href="/writer/logout" class="dropdown-item">Logout</a>
                </div>
            </li>
              <li>
                <strong class="text-uppercase text-blue headings-font-family">{{$userDetails["name"]}}</strong>
                <br><small>{{$userDetails["role"]}} Account</small>
              </li>
          @else
          <li class="nav-item dropdown ml-auto">
              <a id="userInfo" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                <small class="text-gray-500 px-2">My Account</small>
                <img src="{{asset('img/user.svg')}}" class="img-fluid rounded-circle shadow">
              </a>
              <div aria-labelledby="userInfo" class="dropdown-menu">
                <a href="/writer/login" class="dropdown-item">Login</a>
                <div class="dropdown-divider"></div>
                <a href="/writer/register" class="dropdown-item">Register</a>
              </div>
          </li>
          @endif
     </ul>
  </nav>
</header>