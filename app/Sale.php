<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['lotting_id','auction_id','invoice_id','buyer_id','vendor_id','form_no','item_no','lot_no','quantity','rate','discount','buyers_premium_amount'];

    public function stock()
    {
    	return $this->belongsTo(Lotting::class);
    }
}
