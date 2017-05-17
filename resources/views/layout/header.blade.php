<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('dashboard') }}">Al-inayat</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="{{ route('edit.profile') }}">Edit Profile</a></li>
            <li><a href="{{ route('show.payment') }}">Transactions</a></li>
            @can('admin-can-see')
            <li><a href="{{ route('admin.index') }}">Manage Users</a></li>
            @endcan
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a><img class="avatar1" src="{{ Auth::user()->getAvatar() }}" > {{ Auth::user()->fullName() }}</a></li>
            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
        </ul>
    </div>
</nav>