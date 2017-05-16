<?php $now = \Carbon\Carbon::now(); ?>
<div class="row">
    <div class="filter-container col-lg-2 col-lg-offset-2">
        <label for="transaction">Transaction</label>
        <select id="transaction" class="form-control">
            <?php $_GET['transaction'] ?>
            <option value="all">All</option>
            <option value="ramadan">Ramadan</option>
            <option value="savings">Savings</option>
            <option {{ $_GET['transaction'] == 'shares' }} value="shares">Shares</option>
            <option {{ $_GET['transaction'] == 'education' }} value="education">Education</option>
            <option {{ $_GET['transaction'] == 'ileya' }} value="ileya">Ileya</option>
            <option {{ $_GET['transaction'] == 'commodity' }} value="commodity">Commodity</option>
            <option {{ $_GET['transaction'] == 'loans' }} value="loans">Loans</option>
            <option {{ $_GET['transaction'] == 'special_savings' }} value="special_savings">Special Savings</option>
            <option {{ $_GET['transaction'] == 'admin_charges' }} value="admin_charges">Admin Charges</option>
            </select>
    </div>

    <div class="filter-container col-lg-2">
        <label for="type">Type</label>
        <select id="type" class="form-control">
            <option value="all">All</option>
            <option value="credit">Credit</option>
            <option value="debit">Debit</option>
        </select>
    </div>

    <div class="filter-container col-lg-2">
        <label for="from">From</label>
        <input type="text" id="from" class="form-control" placeholder="From Date" value="{{ $_GET['from'] ?? \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d') }}">
    </div>

    <div class="filter-container col-lg-2">
        <label for="to">To</label>
        <input type="text" id="to" class="form-control" placeholder="To Date" value="{{ $_GET['to'] ?? \Carbon\Carbon::now()->format('Y-m-d') }}">
    </div>

    <div class="filter-container col-lg-2">
        <button id="filter-submit" type="submit" class="btn btn-primary filter-submit">Submit</button>
        <button id="filter-clear" type="reset" class="btn btn-default filter-submit">Clear</button>
    </div>
</div>
