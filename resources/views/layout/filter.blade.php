<div class="form-inline pull-right">
    <form class="form-inline" action="{{ route('admin.reports', 'sort') }}" method="get">
        <div class="form-group col-xs-4 col-md-4">
            <label for="email">Transaction:</label>
            <select class="form-control" name="transaction" id="sel1">
                <option>Select</option>
                <option value="savings">Savings</option>
                <option value="commodity">Commodity</option>
                <option value="shares">Shares</option>
                <option value="loans">Loans</option>
                <option value="ileya">Ileya</option>
                <option value="ramadan">Ramadan</option>
                <option value="education">Education</option>
                <option value="special_savings">Special Savings</option>
                <option value="admin_charges">Admin Charges</option>
            </select>
        </div>
        <div class="form-group col-xs-4 col-md-4">
            <br>
            <label for="pwd">Type:</label>
            <select class="form-control" name="type" disabled>
                <option>Select</option>
                <option value="credit">Credit</option>
                <option value="debit">Debit</option>
            </select>
        </div>
        <div class="form-group">
            <br>
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
<br>