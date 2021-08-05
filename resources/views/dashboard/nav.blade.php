<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light prospect-sidebar" id="sidebar">
    <div class="container-fluid">

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse"
            aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="/home">
            <!-- <img src="{{ asset('img/prospect-logo.png') }}" class="navbar-brand-img 
          mx-auto" alt="..."> -->
            <h1 class="text-primary">NEW DMS</h1>
        </a>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidebarCollapse">

            <!-- Navigation -->
            <ul class="navbar-nav prospect-sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="/home">
                        <i class="fe fe-user"></i> {{ explode(' ', auth()->user()->name)[0]}}'s Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.domain.index')}}">
                        <i class="fe fe-aperture"></i> Domains
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.post.index')}}">
                        <i class="fe fe-aperture"></i> Articles
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="/user/sites">
                        <i class="fe fe-aperture"></i> Sites
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/user/shortcodes">
                        <i class="fe fe-code"></i> Shortcodes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/user/templates">
                        <i class="fe fe-grid"></i> Templates
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/user/analytics">
                        <i class="fe fe-trending-up"></i> Analytics
                    </a>
                </li> -->
            </ul>

            <!-- Divider -->
            <hr class="navbar-divider my-3">
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="http://prrage.com/sellers-replay" target="new" class="nav-link">
                        <i class="fe fe-info"></i> Reach Hot Buyers For Your Domains.
                        See How To Automate The Process</a>
                </li>
            </ul>


            <!-- Divider -->
            <hr class="navbar-divider my-3">
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="http://umo.zendesk.com" target="new" class="nav-link">
                        <i class="fe fe-help-circle"></i> Help &amp; Support</a>
                </li>
                <li class="nav-item">
                    <a href="http://prrage.com/dms/tutorials" target="new" class="nav-link">
                        <i class="fe fe-youtube"></i> Tutorials</a>
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
                        <i class="fe fe-git-branch"></i> Version <span class="badge badge-primary ml-auto">v1.0.0</span>
                    </a>
                </li>
            </ul>

            <!-- Divider -->
            <hr class="navbar-divider my-3">
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item mb-3">
                    <a class="ml-4 btn btn-outline-primary w-75" href="/home">
                        <i class="fe fe-user"></i> Profile</a>
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