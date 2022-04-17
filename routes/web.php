<?php

use App\Http\Controllers\CouponProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Cart;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProviderTypeController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\HandymanController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProviderAddressMappingController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\ProviderDocumentController;
use App\Http\Controllers\RatingReviewController;
use App\Http\Controllers\PaymentGatewayController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\ProviderPayoutController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
require __DIR__.'/auth.php';
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::group(['prefix' => 'auth'], function() {
    Route::get('login', [HomeController::class, 'authLogin'])->name('auth.login');
    Route::get('register', [HomeController::class, 'authRegister'])->name('auth.register');
    Route::get('recover-password', [HomeController::class, 'authRecoverPassword'])->name('auth.recover-password');
    Route::get('confirm-email', [HomeController::class, 'authConfirmEmail'])->name('auth.confirm-email');
    Route::get('lock-screen', [HomeController::class, 'authlockScreen'])->name('auth.lock-screen');
});

Route::get('lang/{locale}', [HomeController::class,'lang'])->name('switch-language');

Route::group(['middleware' => ['auth', 'verified']], function()
{
    Route::get('test', function () {

   });


    // orders
    Route::get('get-orders/{id}',[OrderController::class,'getOrders'])->name('get-orders');
    Route::get('get-order/{id}',[OrderController::class,'getOrder'])->name('get-order');
    Route::put('accept_order/{id}',[OrderController::class,'accept_order'])->name('accept_order');
    Route::put('reject_order/{id}',[OrderController::class,'reject_order'])->name('reject_order');
    Route::put('done_order/{id}',[OrderController::class,'done_order'])->name('done_order');
    // orders

    // coupons for products
    Route::get('product_coupons', [CouponProductController::class, 'index'])->name('product_coupons');
    Route::get('create_product_coupons', [CouponProductController::class, 'create'])->name('create_product_coupons');
    Route::post('create_product_coupons', [CouponProductController::class, 'storeCoupon'])->name('create_product_coupons');
    Route::get('edit_product_coupons/{id}', [CouponProductController::class, 'edit'])->name('edit_product_coupons');
    Route::patch('update_product_coupons/{id}', [CouponProductController::class, 'update'])->name('update_product_coupons');
    Route::delete('delete_product_coupons/{id}', [CouponProductController::class, 'destroy'])->name('delete_product_coupons');

        Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::group(['namespace' => '' ], function () {
        Route::resource('permission',PermissionController::class);
        Route::get('permission/add/{type}',[PermissionController::class,'addPermission'])->name('permission.add');
        Route::post('permission/save',[PermissionController::class,'savePermission'])->name('permission.save');

    });
    Route::resource('role', RoleController::class);

    Route::get('changeStatus', [ HomeController::class, 'changeStatus'])->name('changeStatus');

	// product categories && products
//    Route::resource('product_categories', ProductCategoryController::class);
    Route::resource('products', ProductController::class);


    Route::get('test', function (){
        $cart = Cart::with('product', 'user')->get();
        return $cart;
    });

    // product categories && products

    Route::resource('category', CategoryController::class);
    Route::post('category-action',[CategoryController::class, 'action'])->name('category.action');
    Route::resource('service', ServiceController::class);
    Route::post('service-action',[ServiceController::class, 'action'])->name('service.action');
    Route::resource('provider', ProviderController::class);
    Route::resource('provideraddress', ProviderAddressMappingController::class);
    Route::get('provider/list/{status?}', [ProviderController::class,'index'])->name('provider.pending');
    Route::post('provider-action',[ProviderController::class, 'action'])->name('provider.action');
    Route::resource('providertype', ProviderTypeController::class);
    Route::post('providertype-action',[ProviderTypeController::class, 'action'])->name('providertype.action');
    Route::resource('handyman', HandymanController::class);
    Route::get('handyman/list/{status?}', [HandymanController::class,'index'])->name('handyman.pending');
    Route::post('handyman-action',[HandymanController::class, 'action'])->name('handyman.action');
    Route::resource('coupon', CouponController::class);
    Route::post('coupons-action',[CouponController::class, 'action'])->name('coupon.action');
    Route::resource('booking', BookingController::class);
    Route::post('booking-save', [ App\Http\Controllers\BookingController::class, 'store' ] )->name('booking.save');
    Route::post('booking-action',[BookingController::class, 'action'])->name('booking.action');
    Route::resource('slider', SliderController::class);
    Route::post('slider-action',[SliderController::class, 'action'])->name('slider.action');
    Route::resource('payment', PaymentController::class);
    Route::post('save-payment',[App\Http\Controllers\API\PaymentController::class, 'savePayment'])->name('payment.save');
    Route::resource('user', CustomerController::class);
    Route::post('user-action',[CustomerController::class, 'action'])->name('user.action');

    Route::get('booking-assign-form/{id}',[BookingController::class,'bookingAssignForm'])->name('booking.assign_form');
    Route::post('booking-assigned',[BookingController::class,'bookingAssigned'])->name('booking.assigned');

    // Setting
    Route::get('setting/{page?}',[ SettingController::class, 'settings'])->name('setting.index');
    Route::post('/layout-page',[ SettingController::class, 'layoutPage'])->name('layout_page');
    Route::post('/layout-page',[ SettingController::class, 'layoutPage'])->name('layout_page');
    Route::post('settings/save',[ SettingController::class , 'settingsUpdates'])->name('settingsUpdates');
    Route::post('save-app-download',[ SettingController::class , 'saveAppDownloadSetting'])->name('saveAppDownload');
    Route::post('config-save',[ SettingController::class , 'configUpdate'])->name('configUpdate');


    Route::post('env-setting', [ SettingController::class , 'envChanges'])->name('envSetting');
    Route::post('update-profile', [ SettingController::class , 'updateProfile'])->name('updateProfile');
    Route::post('change-password', [ SettingController::class , 'changePassword'])->name('changePassword');

    Route::get('notification-list',[ NotificationController::class ,'notificationList'])->name('notification.list');
    Route::get('notification-counts',[ NotificationController::class ,'notificationCounts'])->name('notification.counts');
    Route::get('notification',[ NotificationController::class ,'index'])->name('notification.index');

    Route::post('remove-file', [ App\Http\Controllers\HomeController::class, 'removeFile' ] )->name('remove.file');
    Route::post('get-lang-file', [ App\Http\Controllers\LanguageController::class, 'getFile' ] )->name('getLangFile');
    Route::post('save-lang-file', [ App\Http\Controllers\LanguageController::class, 'saveFileContent' ] )->name('saveLangContent');

    Route::get('pages/term-condition',[ SettingController::class, 'termAndCondition'])->name('term-condition');
    Route::post('term-condition-save',[ SettingController::class, 'saveTermAndCondition'])->name('term-condition-save');

    Route::get('pages/privacy-policy',[ SettingController::class, 'privacyPolicy'])->name('privacy-policy');
    Route::post('privacy-policy-save',[ SettingController::class, 'savePrivacyPolicy'])->name('privacy-policy-save');

    Route::resource('document', DocumentsController::class);
    Route::post('document-action',[DocumentsController::class, 'action'])->name('document.action');

    Route::resource('providerdocument', ProviderDocumentController::class);
    Route::post('providerdocument-action',[ProviderDocumentController::class, 'action'])->name('providerdocument.action');

    Route::resource('ratingreview', RatingReviewController::class);
    Route::post('ratingreview-action',[RatingReviewController::class, 'action'])->name('ratingreview.action');

    Route::post('/payment-layout-page',[ PaymentGatewayController::class, 'paymentPage'])->name('payment_layout_page');
    Route::post('payment-settings/save',[ PaymentGatewayController::class , 'paymentsettingsUpdates'])->name('paymentsettingsUpdates');
    Route::post('get_payment_config',[ PaymentGatewayController::class , 'getPaymentConfig'])->name('getPaymentConfig');

    Route::resource('tax', TaxController::class);
    Route::get('earning',[EarningController::class,'index'])->name('earning');
    Route::get('earning-data',[EarningController::class,'setEarningData'])->name('earningData');

    Route::resource('providerpayout', ProviderPayoutController::class);
    Route::get('providerpayout/create/{id}', [ProviderPayoutController::class,'create'])->name('providerpayout.create');


});
Route::get('/ajax-list',[HomeController::class, 'getAjaxList'])->name('ajax-list');








