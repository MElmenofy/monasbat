<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponProduct extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function provider(){
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getCategoryIdAttribute($value)
    {
        return explode(',',$value);
    }
    public function getProductIdAttribute($value)
    {
        return explode(',',$value);
    }
}
