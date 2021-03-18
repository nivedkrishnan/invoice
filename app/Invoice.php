<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public $fillable = ['id','user_id','product','quantity','price','total_amount','total_tax','total_after_tax','created_at ','updated_at '];

}
