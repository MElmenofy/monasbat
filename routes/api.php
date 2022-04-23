<?php

use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\API;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
normal api_token
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::get('all-coupons',[API\CouponProductController::class,'getAll']);
//    SHIPPING
Route::get('getShipping',[ API\ShippingController::class, 'getShipping' ]);
//    /SHIPPING

Route::get('category-list',[API\CategoryController::class,'getCategoryList']);
Route::get('service-list',[API\ServiceController::class,'getServiceList']);

Route::post('country-list',[ API\CommanController::class, 'getCountryList' ]);
Route::post('state-list',[ API\CommanController::class, 'getStateList' ]);
Route::post('city-list',[ API\CommanController::class, 'getCityList' ]);
Route::get('slider-list',[ API\SliderController::class, 'getSliderList' ]);
Route::get('top-rated-service',[ API\ServiceController::class, 'getTopRatedService' ]);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[API\User\UserController::class, 'register']);
Route::post('login',[API\User\UserController::class,'login']);
Route::post('forgot-password',[ API\User\UserController::class,'forgotPassword']);
Route::post('social-login',[ API\User\UserController::class, 'socialLogin' ]);
Route::post('contact-us', [ API\User\UserController::class, 'contactUs' ] );


Route::get('dashboard-detail',[ API\DashboardController::class, 'dashboardDetail' ]);
Route::get('service-rating-list',[API\ServiceController::class,'getServiceRating']);
Route::get('user-detail',[API\User\UserController::class, 'userDetail']);
Route::post('service-detail', [ API\ServiceController::class, 'getServiceDetail' ] );
Route::get('user-list',[API\User\UserController::class, 'userList']);
Route::get('booking-status', [ API\BookingController::class, 'bookingStatus' ] );

Route::group(['middleware' => ['auth:sanctum']], function () {

    // products
    Route::get('products',[API\ProductController::class,'index']);
    Route::post('products',[API\ProductController::class,'storeProduct']);
    Route::post('product-update/{id}',[API\ProductController::class,'updateProduct']);
    Route::post('product-delete/{id}', [ API\ProductController::class, 'destroy'] );
// /products

// coupon - products
    Route::get('product-coupon/{id}',[API\CouponProductController::class,'index']);
    Route::post('product-coupon',[API\CouponProductController::class,'storeCoupon']);
    Route::post('product-coupon-update/{id}',[API\CouponProductController::class,'update']);
    Route::post('product-coupon-delete/{id}', [ API\CouponProductController::class, 'destroy'] );
// /coupon - products

//  cart
    Route::post('carts',[API\CartController::class,'store']);
    Route::post('updateQ',[API\CartController::class,'updateQ']);
    Route::get('getCart/{id}',[API\CartController::class,'getCart']);
    Route::post('cart-delete/{id}', [ API\CartController::class, 'destroy'] );
//  /cart

// orders
    Route::post('create-order',[API\OrderController::class,'createOrder']);
    Route::get('get-orders/{id}',[API\OrderController::class,'getOrders']);
    Route::get('get-user-orders/{id}',[API\OrderController::class,'getUserOrders']);
//  accepted
    Route::get('accepted-orders/{id}',[API\OrderController::class,'getAcceptedOrders']);
    Route::post('accept_order/{id}',[API\OrderController::class,'accept_order']);
    Route::post('reject_order',[API\OrderController::class,'reject_order']);
    Route::post('cancel_order',[API\OrderController::class,'cancel_order']);
    Route::post('done_order/{id}',[API\OrderController::class,'done_order']);
// orders

// favourite
    Route::post('save-favourite-product',[ API\UserFavouriteProductController::class, 'saveFavouriteProduct' ]);
    Route::post('delete-favourite-product',[ API\UserFavouriteProductController::class, 'deleteFavouriteProduct' ]);
    Route::get('user-favourite-product/{id}',[ API\UserFavouriteProductController::class, 'getUserFavouriteProduct' ]);
    Route::get('user-f-product/{id}',[ API\UserFavouriteProductController::class, 'getFavouriteProduct' ]);
// /favourite



    Route::post('service-save', [ App\Http\Controllers\ServiceController::class, 'store' ] );
    Route::post('service-delete/{id}', [ App\Http\Controllers\ServiceController::class, 'destroy' ] );
    Route::post('booking-save', [ App\Http\Controllers\BookingController::class, 'store' ] );
    Route::post('booking-update', [ API\BookingController::class, 'bookingUpdate' ] );
    Route::get('provider-dashboard',[ API\DashboardController::class, 'providerDashboard' ]);

    Route::get('booking-list', [ API\BookingController::class, 'getBookingList' ] );
    Route::post('booking-detail', [ API\BookingController::class, 'getBookingDetail' ] );
    Route::post('save-booking-rating', [ API\BookingController::class, 'saveBookingRating' ] );
    Route::post('delete-booking-rating', [ API\BookingController::class, 'deleteBookingRating' ] );

    Route::post('save-favourite',[ API\ServiceController::class, 'saveFavouriteService' ]);
    Route::post('delete-favourite',[ API\ServiceController::class, 'deleteFavouriteService' ]);
    Route::get('user-favourite-service',[ API\ServiceController::class, 'getUserFavouriteService' ]);


    Route::post('booking-action',[ API\BookingController::class, 'action' ] );

    Route::post('booking-assigned',[ App\Http\Controllers\BookingController::class,'bookingAssigned'] );

    Route::post('user-update-status',[API\User\UserController::class, 'userStatusUpdate']);
    Route::post('change-password',[API\User\UserController::class, 'changePassword']);
    Route::post('update-profile',[API\User\UserController::class,'updateProfile']);

    Route::post('notification-list',[API\NotificationController::class,'notificationList']);
    Route::post('remove-file', [ App\Http\Controllers\HomeController::class, 'removeFile' ] );
    Route::get('logout',[ API\User\UserController::class, 'logout' ]);

    Route::post('save-payment',[API\PaymentController::class, 'savePayment']);
    Route::get('payment-list',[API\PaymentController::class, 'paymentList']);


    Route::post('save-provideraddress', [ App\Http\Controllers\ProviderAddressMappingController::class, 'store' ]);
    Route::get('provideraddress-list', [ API\ProviderAddressMappingController::class, 'getProviderAddressList' ]);
    Route::post('provideraddress-delete/{id}', [ App\Http\Controllers\ProviderAddressMappingController::class, 'destroy' ]);

    Route::post('save-handyman-rating', [ API\BookingController::class, 'saveHandymanRating' ] );
    Route::post('delete-handyman-rating', [ API\BookingController::class, 'deleteHandymanRating' ] );

    Route::get('document-list', [ API\DocumentsController::class, 'getDocumentList' ] );
    Route::get('provider-document-list', [ API\ProviderDocumentController::class, 'getProviderDocumentList' ] );
    Route::post('provider-document-save', [ App\Http\Controllers\ProviderDocumentController::class, 'store' ] );
    Route::post('provider-document-delete/{id}', [ App\Http\Controllers\ProviderDocumentController::class, 'destroy' ] );

    Route::get('tax-list',[ API\CommanController::class, 'getProviderTax' ]);


});
