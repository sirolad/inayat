@if ( session()->has('info'))
    <div class="alert alert-info" role-"alert">
        <b>{{ session()->get('info') }}</b>
    </div>
@elseif( session()->has('danger'))
    <div class="alert alert-danger" role-"alert">
        <b>{{ session()->get('danger') }}</b>
    </div>
@elseif( session()->has('warning'))
    <div class="alert alert-warning" role-"alert">
    <b>{{ session()->get('warning') }}</b>
    </div>
@elseif( session()->has('success'))
    <div class="alert alert-success" role-"alert">
    <b>{{ session()->get('success') }}</b>
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li><b>{{ $error }}</b></li>
            @endforeach
        </ul>
    </div>
@endif
