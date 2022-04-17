<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected  $guarded = [];

    public function service(){
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function cart(){
        return $this->belongsTo(Cart::class, 'product_id', 'id');
    }

    public function status(){
        return $this->status ? 'Active' : 'Inactive';
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity'); // فيه علاقه مع ال quantity
    }

    public function getUserFavouriteProduct(){
        return $this->belongsTo(UserFavouriteProduct::class, 'product_id','id');
    }
}
