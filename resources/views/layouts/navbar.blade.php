<nav id="topbar" class="navbar bg-white border-bottom fixed-top topbar px-3">
  <button id="toggleBtn" class="d-none d-lg-inline-flex btn btn-light btn-icon btn-sm ">
    <i class="ti ti-layout-sidebar-left-expand"></i>
  </button>

  <!-- MOBILE -->
  <button id="mobileBtn" class="btn btn-light btn-icon btn-sm d-lg-none me-2">
    <i class="ti ti-layout-sidebar-left-expand"></i>
  </button>

  <div>
    <ul class="list-unstyled d-flex align-items-center mb-0 gap-1">
      <!-- Notifications -->
      <li>
        <a class="position-relative btn-icon btn-sm btn-light btn rounded-circle" data-bs-toggle="dropdown"
          aria-expanded="false" href="#" role="button">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
            class="icon icon-tabler icons-tabler-outline icon-tabler-bell">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
            <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
          </svg>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger mt-2 ms-n2">
            0
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-md p-0">
          <ul class="list-unstyled p-0 m-0">
            <li class="p-3 border-bottom text-center">
              <p class="mb-0 small">No new notifications</p>
            </li>
          </ul>
        </div>
      </li>

      <!-- User Profile Dropdown -->
      <li class="ms-3 dropdown">
        <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="{{ asset('inapp/dist/assets/images/avatar-1.jpg') }}" alt=""
            class="avatar avatar-sm rounded-circle" />
        </a>
        <div class="dropdown-menu dropdown-menu-end p-0" style="min-width: 200px;">
          <div>
            <div class="d-flex gap-3 align-items-center border-dashed border-bottom px-3 py-3">
              <img src="{{ asset('inapp/dist/assets/images/avatar-1.jpg') }}" alt=""
                class="avatar avatar-md rounded-circle" />
              <div>
                <h4 class="mb-0 small">{{ Auth::user()->name }}</h4>
                <p class="mb-0 small text-muted text-truncate" style="max-width: 120px;">{{
                  Auth::user()->email }}</p>
              </div>
            </div>
            <div class="p-3 d-flex flex-column gap-1 small lh-lg">
              <a href="{{ route('profile.edit') }}" class="text-decoration-none text-dark">
                <span>Account Settings</span>
              </a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="text-decoration-none text-danger"
                  onclick="event.preventDefault(); this.closest('form').submit();">
                  <span>Logout</span>
                </a>
              </form>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </div>
</nav>