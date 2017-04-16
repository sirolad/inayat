<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Al-inayat</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Edit Profile</a></li>
            <li><a href="#">Page 1</a></li>
            <li><a href="{{ route('admin.index') }}">Manage Users</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
        </ul>
    </div>
</nav>