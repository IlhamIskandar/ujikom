<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SppPayment extends Model
{
    use HasFactory;
    protected $table = "spp_payments";
    protected $primaryKey = 'spp_payment_id';

}
