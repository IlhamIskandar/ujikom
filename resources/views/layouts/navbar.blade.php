<style type="text/css">
	.navbar {
		/*width: 100%;*/
		height: 60px;
		/*background: lightgrey;
		border-bottom: 2px;
		border-color: black;
		margin: 0;
		padding: 0;*/
	}
</style>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg {{-- navbar-dark bg-primary --}}">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0" href="#">
        <h3>SPP Nekat</h3>
      </a>
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="{{route('home')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('student.index')}}">Siswa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('payment.entry')}}">Pembayaran</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.index')}}">Admin</a>
        </li>
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->

    <!-- Right elements -->
    <div class="d-flex align-items-center">
            <!-- Avatar -->
    @guest

    @else
      <div class="dropdown">
        <a
          class="dropdown-toggle d-flex align-items-center hidden-arrow"
          href="#"
          id="navbarDropdownMenuAvatar"
          role="button"
          data-mdb-toggle="dropdown"
          aria-expanded="false"
        >
        {{ Auth::user()->name }}
          <img
            src="{{asset('storage/img/blank-user-avatar.jpg')}}"
            class="rounded-circle ps-2"
            height="25"
            alt="+"
            loading="lazy"
          />
        </a>
        <ul
          class="dropdown-menu dropdown-menu-end"
          aria-labelledby="navbarDropdownMenuAvatar"
        >
          <li>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </li>
        </ul>
      </div>
    @endguest

    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->