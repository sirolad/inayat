<?php

namespace Inayat;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    const STATUS_PENDING = 'pending';

    const STATUS_ACTIVE = 'active';

    const STATUS_DECLINED = 'declined';

    const TYPE_DEBIT = 'debit';

    const TYPE_CREDIT = 'credit';

    /**
     * Relationship with Users
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function users()
    {
        return $this->belongsTo('Inayat\User');
    }
}
