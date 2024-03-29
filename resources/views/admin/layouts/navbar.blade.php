  <style type="text/css">
  body {
  background-color: #fbfbfb;
}
@media (min-width: 991.98px) {
  main {
    padding-left: 240px;
  }
}

/* Sidebar */
.sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  padding: 58px 0 0;
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
  width: 240px;
  z-index: 600;
}

@media (max-width: 991.98px) {
  .sidebar {
    width: 100%;
  }
}
.sidebar .active {
  border-radius: 5px;
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
}

.sidebar-sticky {
  position: relative;
  top: 0;
  height: calc(100vh - 48px);
  padding-top: 0.5rem;
  overflow-x: hidden;
  overflow-y: auto;
}
</style>
<header>
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <a
          href="{{route('admin.index')}}"
          class="list-group-item list-group-item-action py-2 ripple {{ request()->is('admin') ? 'active' : '' }}"
          aria-current="true"
        >
          <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>
        </a>
        <a href="{{route('admin.spp.index')}}" class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.spp.*') ? 'active' : '' }}">
          <i class="fas fa-calendar-days fa-fw me-3"></i><span>SPP</span>
        </a>
        <a href="{{route('admin.class.index')}}" class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.class.*') ? 'active' : '' }}"
          ><i class="fas fa-chalkboard fa-fw me-3"></i></i><span>Kelas</span></a
        >
        <a href="{{route('admin.student.index')}}" class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.student.*') ? 'active' : '' }}"
          ><i class="fas fa-user-graduate fa-fw me-3"></i><span>Siswa</span></a
        >
        <a href="{{route('admin.staff.index')}}" class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.staff.*') ? 'active' : '' }}">
          <i class="fas fa-user-tie fa-fw me-3"></i></i><span>Staff</span>
        </a>
        <a href="{{route('admin.payment.index')}}" class="list-group-item list-group-item-action py-2 ripple {{ request()->routeIs('admin.payment.*') ? 'active' : '' }}" 
          ><i class="fas fa-money-bill fa-fw me-3"></i></i><span>Pembayaran</span></a
        >
      </div>
    </div>
  </nav>
  <!-- Sidebar -->

  <!-- Navbar -->
  <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#sidebarMenu"
        aria-controls="sidebarMenu"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>

      <!-- Brand -->
      <a class="navbar-brand" href="/">
        <img
          src="{{asset('storage/img/smknekat-logo.png')}}"
          height="30"
        />
        <span>SMKN 1 Katapang</span>
      </a>

      <!-- Right links -->
      @guest
      @else
      <ul class="navbar-nav ms-auto d-flex flex-row">
        <!-- Avatar -->
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center"
            href="#"
            id="navbarDropdownMenuLink"
            role="button"
            data-mdb-toggle="dropdown"
            aria-expanded="false"
          >
          <span class="me-2">{{ Auth::user()->name }}</span>
            <img
              src="{{asset('storage/img/blank-user-avatar.jpg')}}"
              class="rounded-circle"
              height="22"
              alt="="
              loading="lazy"
            />
          </a>
          <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="navbarDropdownMenuLink"
          >
            <li>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
            </li>
          </ul>
        </li>
      </ul>
      @endguest
    </div>
    <!-- Container wrapper -->
  </nav>
  <!-- Navbar -->
</header>
<!--Main Navigation-->