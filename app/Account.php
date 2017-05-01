<?php

namespace Inayat;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    const STATUS_PENDING = 'pending';

    const TYPE_DEBIT = 'debit';

    const TYPE_CREDIT = 'credit';
}
