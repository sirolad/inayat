@extends('layout.admin-master')
@section('content')
    <div class="container">
        <div class="jumbotron">
            @include('layout.alerts')
            <div class="table-responsive">
                <table class="css-serial table">
                    <h3>Balance</h3>
                    <p>The Current Balance is <b>{{ 'N' . number_format($balance) }}</b>.</p>
                    <br>
                    <h3>All Transactions</h3>
                    @include('layout.filter')
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Creditor</th>
                        <th>Amount</th>
                        <th>Reference</th>
                        <th>Transaction</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Approver</th>
                        <th>Transaction Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        @if($transaction->type == 'debit')
                        <tr class="danger" id="row{{ $transaction->id }}">
                        @else
                        <tr class="success" id="row{{ $transaction->id }}">
                        @endif
                            <td> </td>
                            <td>{{ $transaction->user->fullName() }}</td>
                            <td>{{ number_format($transaction->amount) }}</td>
                            <td>{{ $transaction->reference }}</td>
                            <td>{{ ucfirst($transaction->transaction) }}</td>
                            <td>{{ $transaction->type }}</td>
                            <td>{{ ucfirst($transaction->status) }}</td>
                            <td>{{ $transaction->approver }}</td>
                            <td>{{ $transaction->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection