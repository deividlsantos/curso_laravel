<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
    protected $fillable = ['type', 'amount', 'total_before', 'total_after', 'date', 'user_id_transaction'];
}


