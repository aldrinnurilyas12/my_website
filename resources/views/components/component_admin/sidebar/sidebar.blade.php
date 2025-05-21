<link href="{{ asset('assets/front_end/css/styles.css') }}" rel="stylesheet" />

<body>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">MASTER DATA</div>
                        <a class="nav-link" href="{{ route('dailyposts.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-tags" aria-hidden="true"></i>
                            </div>
                            Daily Posts
                        </a>

                        <a class="nav-link" href="{{ route('projects.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-cubes" aria-hidden="true"></i>
                            </div>
                            Projects
                        </a>

                        <a class="nav-link" href="{{ route('workingexperiences.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-id-card" aria-hidden="true"></i>
                            </div>
                            Work Experience
                        </a>

                        <a class="nav-link" href="{{ route('podcast.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-id-card" aria-hidden="true"></i>
                            </div>
                            Podcast
                        </a>


                        <a class="nav-link" href="{{ route('profilepictures.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-percent" aria-hidden="true"></i>
                            </div>
                            Profil
                        </a>

                        <hr>

                        <div class="nav-link">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>

                            </form>
                        </div>
                        <hr>



                        <div class="sb-sidenav-menu-heading">
                            {{-- <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-danger" type="submit">Log Out</button>
                            </form> --}}
                        </div>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    {{-- {{app('App\Http\Controllers\Auth\AuthenticatedSessionController')->getUsers()->shop_name}} --}}
                </div>
            </nav>
        </div>

    </div>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap');

        body {
            font-family: "DM Sans", serif;
        }
    </style>
</body>
