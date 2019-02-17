<?php

namespace SYSAuction;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $fillable = ['auction_no','venue','date','time'];
}
