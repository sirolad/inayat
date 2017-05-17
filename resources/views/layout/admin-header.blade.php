<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('admin.index') }}">Al-inayat</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="{{ route('admin.index') }}">Admin Dashboard</a></li>
            <li><a href="{{ route('admin.create') }}">Create Account</a></li>
            <li><a href="{{ route('admin.members') }}">View Members</a></li>
            <li>
                <a data-toggle="dropdown">Reports</a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('admin.reports') }}">All Reports</a></li>
                </ul>
            </li>
        </ul>
        <form class="navbar-form navbar-left">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
            <li><a>{{ 'Administrator' }}</a></li>
            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
        </ul>
    </div>
</nav>