@extends('layout.admin-master')
@section('content')
<div class="container">
    <div class="jumbotron">
        <h3>Admin Dashboard</h3>
        @include('layout.alerts')
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">Total Members</div>
                    <div class="panel-body">{{ count($user) . ' Active Users' }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">Total Transactions</div>
                    <div class="panel-body">{{ count($totalTransactions) . ' Transactions' }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">Pending Transactions</div>
                    <div class="panel-body">{{ count($pendingTransactions) . ' Pending Transactions' }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection