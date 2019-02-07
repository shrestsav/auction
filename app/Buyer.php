<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
     protected $fillable = ['buyer_code','first_name', 'last_name', 'contact_type','buyers_premium ','buyers_premium_rate', 'address', 'suburb','state','postcode', 'telephone_home', 'telephone_work','mobile', 'email', 'comments'];
}
