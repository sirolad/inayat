@extends('layout.admin-master')
@section('content')
    <div class="container">
        <div class="jumbotron">
            <h3>Edit a Transaction For {{ $transaction->user->fullName()}}</h3>
            @include('layout.alerts')
            {{--Transaction Form--}}
            <form class="form-horizontal" method="post" action="{{ route('update.transaction', $transaction->id) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="reference" class="col-4 col-form-label">Reference</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="{{ $transaction->reference }}" id="" name="reference" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="amount" class="col-4 col-form-label">Amount</label>
                    <div class="col-10">
                        <input class="form-control" type="number" value="{{ $transaction->amount }}" id="" name="amount" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="transaction" class="col-4 col-form-label">Transaction</label>
                    <div class="col-10">
                        <select class="custom-select form-control" name="transaction">
                            <option selected value="{{ $transaction->transaction }}">{{ $transaction->transaction }}</option>
                            <option value="shares">Shares</option>
                            <option value="savings">Savings</option>
                            <option value="commodity">Commodity</option>
                            <option value="loans">Loans</option>
                            <option value="ramadan">Ramadan</option>
                            <option value="ileya">Ileya</option>
                            <option value="education">Education</option>
                            <option value="special_savings">Special Savings</option>
                            <option value="admin_charges">Admin Charges</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="col-4 col-form-label">Type</label>
                    <div class="col-10">
                        <select class="custom-select form-control" name="type">
                            <option selected value="{{ $transaction->type }}">{{ $transaction->type }}</option>
                            <option value="credit">Credit</option>
                            <option value="debit">Debit</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Edit Transaction</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </div>
                </div>
            </form>
            @can('super-admin-can-see')
                    <br>
                    <a href="{{ route('delete.transaction', $transaction->id)}}"
                    data-toggle="tooltip" title="Delete Member"><button class=btn-danger>Delete {{ $transaction->reference }}</button>
                    </a>
        @endcan
        </div>
    </div>
@endsection