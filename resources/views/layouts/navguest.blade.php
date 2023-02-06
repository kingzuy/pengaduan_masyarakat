<!-- Navbar -->
<nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
    <div class="container">
        <a class="navbar-brand font-weight-bolder text-white me-9" href="/">
            PDMK
        </a>
        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav mx-auto">

            </ul>
            <ul class="navbar-nav d-lg-block d-flex">
                <li class="nav-item">
                    @auth
                        <div class="dropdown">
                            <a class="nav-link d-flex align-items-center dropdown-toggle me-2 active" href=""
                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" style="top: 0 !important;" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="{{ url('/home') }}">Home</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ url('/pengaduan') }}">Ajukan Pengaduan</a></li>
                                <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                                    @csrf

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </a>
                                </form>
                            </ul>
                        </div>
                    @else
                        @if (request()->is('login'))
                            <a href="{{ route('register') }}" class="btn btn-sm mb-0 me-1 bg-gradient-light">Sign Up</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-sm mb-0 me-1 bg-gradient-light">Sign In</a>
                        @endif
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
