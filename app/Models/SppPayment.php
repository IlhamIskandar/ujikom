<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SppPayment extends Model
{
    use HasFactory;
    protected $table = "spp_payments";
    protected $primaryKey = 'spp_payment_id';
    // protected $dateFormat = 'U';
    protected $fillable = [
        'user_id',
    	'nisn',
        'payer',
        'payment_date',
    	'spp_id',
    	'pay_amount',
        'information',
        'code',
    ];
}
