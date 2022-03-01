<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const SOURCE_ADDON_PAYMENTS = 'addon_payments';

    protected $fillable = [
        'order_id',
        'user_id',
        'source',
        'transaction',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

}
