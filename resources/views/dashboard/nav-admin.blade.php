<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light prospect-sidebar" id="sidebar">
    <div class="container-fluid">

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse"
            aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" target="new" href="http://prospectdynamic.com">
            <!-- <img src="{{ asset('img/prospect-logo.png') }}" class="navbar-brand-img 
          mx-auto" alt="..."> -->
            <h1 class="text-primary">NEW DMS ADMIN</h1>
        </a>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidebarCollapse">

            <!-- Navigation -->
            <ul class="navbar-nav prospect-sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('admin.dashboard')}}">
                        <i class="fe fe-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.users.index')}}">
                        <i class="fe fe-users"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.plans.index')}}">
                        <i class="fe fe-users"></i> Plans
                    </a>
                </li>

            </ul>


            <!-- Divider -->
            <hr class="navbar-divider my-3">

            <!-- Heading -->
            <!-- <h6 class="navbar-heading">
                Plugin History
            </h6> -->

            <!-- Navigation -->
            <ul class="navbar-nav mb-md-4">

                <li class="nav-item">
                    <a class="nav-link " href="#">
                        <i class="fe fe-git-branch"></i> Version <span class="badge badge-primary ml-auto">v2.0.0</span>
                    </a>
                </li>
            </ul>

            <!-- Divider -->
            <hr class="navbar-divider my-3">
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item mb-3">
                    <a class="ml-4 btn btn-outline-primary w-75" href="/admin/profile">
                        <i class="fe fe-user"></i> Howdy {{ explode(' ', auth()->user()->name)[0] }}</a>
                </li>
                <li class="nav-item">
                    <a class="ml-4 btn btn-outline-danger w-75" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fe fe-log-out"></i> Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

            </ul>

            <!-- Push content down -->
            <div class="mt-auto"></div>


        </div> <!-- / .navbar-collapse -->

    </div>
</nav>