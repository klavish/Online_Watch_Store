<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authenticationcontroller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::controller(HomeController::class)->group(function(){
Route::get('/', 'index')->name('home');
Route::get('/view-product/{product:product_code}', 'productInfo')->name('product_info');
Route::get('/list-product', 'productList')->name('product_list');

});
// Route::get('/', function () {                                                                                     
//     return view('user_index');
// })->name('home');                                                      

Route::controller(Authenticationcontroller::class)->group(function (){
Route::get('/register', 'register')->name('register');
Route::post('/register', 'storeUser')->name('store_user');
Route::get('/login', 'login')->name('login');
Route::post('/login', 'authenticate')->name('authenticate');
Route::get('/forgot-password', 'forgotPassword')->name('forgot_password');
Route::post('/forgot-password', 'sendforgotPasswordEmail')->name('send_forgot_password_email');
Route::get('/reset-password/{token}', 'resetPassword')->name('reset_password');
Route::post('/reset-password', 'resetPasswordData')->name('reset_password_data');
Route::get('/logout', 'logout')->name('logout');

});

Route::resource('cart', \App\Http\Controllers\CartController::class);
Route::get('store-order', [CartController::class,  'storeOrder'])->name('store_order');
Route::post('add-to-cart', [CartController::class,  'addToCart'])->name('add_to_cart');

Route::controller(UserController::class)->group(function (){
Route::get('/profile', 'userProfile')->name('user_profile');
Route::put('/profile', 'userProfileUpdate')->name('user_profile_update');
Route::post('/user-image-update', 'userProfileImageUpdate')->name('user_profile_image_update'); //post because we cannot update image through put method
});

Route::group(['prefix' => '/admin', 'middleware' => ['checkRoles']], function(){
 
    Route::controller(AdminController::class)->group(function(){
    Route::get('/', 'index')->name('admin_home');
    Route::get('/user-list', 'usersList')->name('admin_user_list');
    Route::get('/edit-user/{id}', 'editUsers')->name('admin_user_edit');
    Route::put('/update-user/{id}', 'updateUsers')->name('admin_user_update');
    Route::post('/update-user-profile/{id}', 'updateUsersProfile')->name('admin_user_profile_update');
    Route::get('/register-user', 'registerUsersProfile')->name('admin_user_profile_register');
    Route::post('/register-user', 'registerUsersProfileData')->name('admin_user_profile_register_data');
    Route::get('/change-user-status/{id}/{status?}', 'changeUserStatus')->name('admin_change_user_status');
    
});

    Route::resource('brands', BrandsController::class);
    Route::controller(BrandsController::class)->group(function(){
        Route::post('/change-brand-image/{id}', 'changeBrandImage')->name('admin_brand_image_change');
        Route::get('/change-brand-status/{id}/{status?}', 'changeBrandStatus')->name('admin_change_brand_status');
    });

    Route::controller(OrderController::class)->group(function(){
        Route::get('/orders', 'index')->name('list_orders');
        Route::post('/change-order-status/{id}', 'changeOrderStatus')->name('admin_change_order_status');
        Route::get('/lineitems/{id}', 'getLineItems')->name('get_line_items');
        
    });


    Route::resource('product', ProductController::class);
    Route::controller(ProductController::class)->group(function(){
        Route::post('/change-product-image/{id}', 'changeProductImage')->name('admin_product_image_change');
        Route::get('/change-product-status/{id}/{status?}', 'changeProductStatus')->name('admin_change_product_status');
    });

});

