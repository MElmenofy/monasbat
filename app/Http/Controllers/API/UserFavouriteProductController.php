<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserFavouriteProduct;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class UserFavouriteProductController extends Controller
{
    use ApiTrait;
    //
    public function saveFavouriteProduct(Request $request)
    {
        $user_favourite = $request->all();
        $result = UserFavouriteProduct::updateOrCreate(['id' => $request->id], $user_favourite);
        $message = __('messages.update_form',[ 'form' => __('messages.favourite') ] );
        if($result->wasRecentlyCreated){
            $message = __('messages.save_form',[ 'form' => __('messages.favourite') ] );
        }
        return comman_message_response($message);
    }

    public function deleteFavouriteProduct(Request $request)
    {
        $product = UserFavouriteProduct::where('user_id',$request->user_id)->where('product_id',$request->product_id)->delete();
        if ($product){
            return $this->apiData($product, 200, 'favourites Deleted');
        }
    }

    public function getUserFavouriteProduct($id)
    {
        $favourite = UserFavouriteProduct::where('user_id', $id)->get();
        if ($favourite){
            return $this->apiData($favourite, 200, 'favourites');
        }
    }

//    with products
    public function getFavouriteProduct($id)
    {
        $result = UserFavouriteProduct::with('product')->where('user_id', $id)->get();
        if ($result){
            return $this->apiData($result, 200, 'Favourites');
        }else{
            return $this->apiData(null, 200, 'Favourites Not Found');
        }
    }
}
