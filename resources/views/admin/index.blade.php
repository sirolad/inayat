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
                    <div class="panel-body" id="counting">{{ count($transactions) . ' Pending Transactions' }}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">Total Credits</div>
                    <div class="panel-body">{{ 'N' . number_format($credit) }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">Total Debits</div>
                    <div class="panel-body">{{ 'N' . number_format($debit) }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">Current Fund</div>
                    <div class="panel-body" id="counting">{{ 'N' . number_format($balance) }}</div>
                </div>
            </div>
        </div>
        <h3>Pending Transactions</h3>
        @if($transactions)
            @include('layout.admin-table')
        @else
            <p>No Transaction As At Now!</p>
        @endif
    </div>
</div>
@endsection