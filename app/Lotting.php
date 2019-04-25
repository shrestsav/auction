<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lotting extends Model
{
    protected $fillable = ['stock_id','auction_id','vendor_id','lot_no','form_no','item_no','description','quantity','reserve'];

    public function stock()
    {
    	return $this->belongsTo(Stock::class);
    }
    public function sale()
    {
    	return $this->hasMany(Sale::class);
    }
}
