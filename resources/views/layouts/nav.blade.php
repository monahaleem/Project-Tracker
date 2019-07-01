@guest

@else
<div class="custom-message" id="custom-message" style="display: none;">
    <button class="custom-message-btn" id="custom-message-btn">×</button>
    <ul></ul>
</div>
<!-- Navbar  -->
<nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
    <div class="container">
        <a href="#" class="navbar-brand">Project Tracker</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav">

                <li class="nav-item px-2">
                    <a href="{{ route('home') }}" class="nav-link active">Dashboard</a>
                </li>
                <li class="nav-2">
                    <a href="{{ route('project.index') }}" class="nav-link">Projects</a>
                </li>
                <li class="nav-item px-2">
                    <a href="{{ route('task.index') }}" class="nav-link">Tasks </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown mr-3">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="fas fa-user"></i> Welcome {{ auth()->user()->name }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        <i class="fas fa-user-times"></i> {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- HEADER -->
<header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>
                  @yield('page-title')
                </h1>
            </div>
        </div>
    </div>
</header>
@endguest
