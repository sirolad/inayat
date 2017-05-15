@extends('layout.admin-master')
@section('content')
    <div class="container">
        <div class="jumbotron">
            @include('layout.alerts')
            <div class="table-responsive">
                <table class="css-serial table">
                    <h3>All Transactions</h3>
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Creditor</th>
                        <th>Amount</th>
                        <th>Reference</th>
                        <th>Transaction</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Transaction Date</th>
                    </tr>
                    </thead>
                    @foreach($transactions as $transaction)
                        <tbody>
                        <tr class="info" id="row{{ $transaction->id }}">
                            <td> </td>
                            <td>{{ $transaction->user->fullName() }}</td>
                            <td>{{ number_format($transaction->amount) }}</td>
                            <td>{{ $transaction->reference }}</td>
                            <td>{{ ucfirst($transaction->transaction) }}</td>
                            <td>{{ $transaction->type }}</td>
                            <td>{{ ucfirst($transaction->status) }}</td>
                            <td>{{ $transaction->created_at }}</td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection