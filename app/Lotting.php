<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lotting extends Model
{
    protected $fillable = ['auction_id','vendor_id','lot_no','form_no','item_no','description','quantity','reserve'];
}
