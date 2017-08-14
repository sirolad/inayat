@extends('layout.admin-master')
@section('content')
    <div class="container">
        <div class="jumbotron">
        <span class="pull-right">
            <a href="{{ route('excel.transactions') }}">
                <button class="btn-info" data-toggle="tooltip" title="Print All Transactions">Print All Transaction</button>
            </a>
        </span>
            <h3>Balance</h3>
            @include('layout.alerts')
            <div class="table-responsive">
                <table class="css-serial table">
                    <p>The Current Balance is <b>{{ 'N' . number_format($balance) }}</b>.</p>
                    <br>
                    <h3>{{ $type }} Transactions</h3>
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
                            @if(Auth::user()->isSuperAdmin())
                            <td>
                            <a href="{{ route('delete.transaction', $transaction->id) }}"
                            data-toggle="tooltip" title="Delete Transaction">
                                {{ number_format($transaction->amount) }}
                            </a>
                            </td>
                            @else
                            <td>{{ number_format($transaction->amount) }}</td>
                            @endif
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