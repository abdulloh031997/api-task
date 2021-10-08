<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class Shop extends Model
{
    protected $fillable = ['name', 'created_at', 'updated_At'];
    
    // public function Product()
    // {
    //     return $this->belongsTo(Product::class,'shop_id','id');
    // }
    public function product()
    {
        return $this->hasMany('App\Product','shop_id');
    }
}
