<?php

namespace Inayat;

use Illuminate\Database\Eloquent\Model;

class Kin extends Model
{
    protected $fillable = [
        'name', 'relationship', 'kin-address', 'kin-phone', 'memberId'
    ];
}
