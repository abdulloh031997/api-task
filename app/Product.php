<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Shop;
class Product extends Model
{
    protected $fillable = ['shop_id','name', 'price','created_at', 'updated_At'];

    public function shops()
    {
        return $this->hasMany('App\Shop','id','shop_id');
    }
    
}
