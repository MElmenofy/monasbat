<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavouriteProduct extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'product_id'    => 'integer',
        'user_id'       => 'integer',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
