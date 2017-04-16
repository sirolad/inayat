<?php

namespace Inayat;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const MEMBER = 1;

    const DEVELOPER = 2;

    const ADMIN = 3;
}
