@extends('layout.master')
@section('content')
<div class="container">
    @include('layout.alerts')
    <div class="jumbotron">
        <h3>Basic Data</h3>
        <div class="row">
            <div class="col-md-3 form-inline">
                <b>Name</b><p>{{ $user->fullName() }}</p>
            </div>
            <div class="col-md-3 form-inline">
                <b>Phone Number</b><p>{{ $user->phone }}</p>
            </div>
            <div class="col-md-3 form-inline">
                <b>Membership Number</b><p>{{ $user->registration }}</p>
            </div>
            <div class="col-md-3 form-inline">
                <b>Email Address</b><p>{{ $user->email }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 form-inline">
                <b>Address</b><p>{{ $user->address }}</p>
            </div>
            <div class="col-md-3 form-inline">
                <b>Occupation</b><p>{{ $user->occupation }}</p>
            </div>
            <div class="col-md-3 form-inline">
                <b>Marital Status</b><p>{{ $user->maritalStatus }}</p>
            </div>
            <div class="col-md-3 form-inline">
                @if($user->kins)
                    <b>Next of Kin</b><p>{{ $user->kins->name }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="jumbotron">
        <h3>Transaction History</h3>
        @if($transactions)
            @include('layout.table')
        @else
            <p>No Transaction Yet!</p>
        @endif
    </div>
</div>
@endsection