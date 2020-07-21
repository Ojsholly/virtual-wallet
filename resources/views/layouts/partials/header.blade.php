<!-- Header
  ============================================= -->
<header id="header">
    <div class="container">
        <div class="header-row">
            <div class="header-column justify-content-start">
                <!-- Logo
          ============================= -->
                <div class="logo"> <a class="d-flex" href="{{ url('dashboard') }}" title="Payyed - HTML Template"><img
                            src="{{ asset('images/logo.png') }}" alt="Payyed" /></a> </div>
                <!-- Logo end -->

                <!-- Collapse Button
          ============================== -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header-nav">
                    <span></span> <span></span> <span></span> </button>
                <!-- Collapse Button end -->

                @auth
                <!-- Primary Navigation
          ============================== -->
                <nav class="primary-menu navbar navbar-expand-lg">
                    <div id="header-nav" class="collapse navbar-collapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="active"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ url('profile/'.Auth::user()->uuid) }}">Profile</a></li>
                            <li><a href="{{ url('transactions/') }}">Transactions</a></li>
                            <li><a href="{{ url('transactions/transfer') }}">Send Money</a></li>
                            <li><a href="{{ url('activity-log') }}">Activity Log</a></li>
                        </ul>
                    </div>
                </nav>
                <!-- Primary Navigation end -->
            </div>
            <div class="header-column justify-content-end">
                <nav class="login-signup navbar navbar-expand">
                    <ul class="navbar-nav">
                        <li class="align-items-center h-auto ml-sm-3 float-right"><button
                                class="btn btn-outline-primary shadow-none d-none d-sm-block" Onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign
                                out</button></li>
                    </ul>

                </nav>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>

            @else
            <div class="header-column justify-content-end">
                <!-- Login & Signup Link
          ============================== -->
                <nav class="login-signup navbar navbar-expand">
                    <ul class="navbar-nav">
                        <li><a href="profile.html">Register</a> </li>
                        <li class="align-items-center h-auto ml-sm-3"><a
                                class="btn btn-outline-primary shadow-none d-none d-sm-block">Sign in</a></li>
                    </ul>
                </nav>
                <!-- Login & Signup Link end -->
            </div>

            @endauth
        </div>
    </div>
</header>
<!-- Header End -->
