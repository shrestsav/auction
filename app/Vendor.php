<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = ['vendor_code','first_name', 'last_name','company', 'state','joined_date','abn', 'gst_status', 'payment_method','commission','address', 'suburb', 'postcode', 'mobile','email','comments','a/c_no','bsb_no'];
    
    public function stock()
    {
    	return $this->hasMany(Stock::class);
    }

    public function lottings()
    {
    	return $this->hasMany(Lotting::class);
    }
}
