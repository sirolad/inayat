<div class="table-responsive">
    <table class="css-serial table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Amount</th>
            <th>Reference</th>
            <th>Transaction</th>
            <th>Type</th>
            <th>Status</th>
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
                <td>&nbsp;</td>
                <td>{{ number_format($transaction->amount) }}</td>
                <td>{{ $transaction->reference }}</td>
                <td>{{ ucfirst($transaction->transaction) }}</td>
                <td>{{ $transaction->type }}</td>
                <td>{{ ucfirst($transaction->status) }}</td>
                <td>{{ $transaction->created_at->diffForHumans() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>