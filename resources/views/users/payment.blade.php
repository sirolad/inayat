@extends('layout.master')
@section('content')
<div class="container">
    <div class="jumbotron">
        <h3>Register a Transaction</h3>
        {{--Transaction Form--}}
        <form class="form-horizontal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="registration" class="col-4 col-form-label">Reference</label>
                <div class="col-10">
                    <input class="form-control" type="tel" value="" id="" name="registration">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection