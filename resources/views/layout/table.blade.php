<div class="table-responsive">
    <table class="css-serial table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Amount</th>
            <th>Reference</th>
            <th>Transaction</th>
            <th>Status</th>
            <th>Transaction Date</th>
        </tr>
        </thead>
        @foreach($transactions as $transaction)
            <tbody>
            <tr class="info">
                <td>&nbsp;</td>
                <td>{{ number_format($transaction->amount) }}</td>
                <td>{{ $transaction->reference }}</td>
                <td>{{ ucfirst($transaction->transaction) }}</td>
                <td>{{ ucfirst($transaction->status) }}</td>
                <td>{{ $transaction->created_at->diffForHumans() }}</td>
            </tr>
            </tbody>
        @endforeach
    </table>
</div>