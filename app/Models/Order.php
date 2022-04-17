<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

//    public function products(): BelongsToMany
//    {
//        return $this->belongsToMany(Product::class)->withPivot('quantity');
//    }

//    more
//    public function orderProducts(){
//        $this->hasMany(OrderProduct::class);
//    }
}
