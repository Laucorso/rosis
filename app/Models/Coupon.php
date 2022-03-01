<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Coupon extends Model
{
    use HasFactory;

    protected $casts = [
        'starts' => 'datetime:d-m-Y',
        'ends' => 'datetime:d-m-Y'
    ];

    
    // METHODS
    public function validate( Request $request ) {
        return true;
    }
}
