@if ( session()->has('info'))
    <div class="alert alert-info" role-"alert">
        {{ session()->get('info') }}
    </div>
@elseif( session()->has('danger'))
    <div class="alert alert-danger" role-"alert">
        {{ session()->get('danger') }}
    </div>
@elseif( session()->has('warning'))
    <div class="alert alert-warning" role-"alert">
    {{ session()->get('warning') }}
    </div>
@endif
