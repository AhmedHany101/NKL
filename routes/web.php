<?php

use App\Http\Controllers\Admin\admin_ctrl;
use App\Http\Controllers\Auth\auth_ctrl;
use App\Http\Controllers\Localization\Localization_ctrl;
use App\Http\Controllers\Suppliers\Suppliers_Ctrl;
use App\Http\Controllers\User\User_ctrl;
use Illuminate\Database\Schema\Grammars\ChangeColumn;
use Illuminate\Support\Facades\Route;


//errro page 
Route::fallback(function () {

    return view('users_pages/errors-404');
});
//===================== 
//localization function 
Route::get('locale/{lang}', [\App\Http\Controllers\Localization\Localization_ctrl::class, 'setLang'])->name('setLang');
//=====================================
//login and register routes and email verfication and logout
//***login page***
Route::get('/signin', [auth_ctrl::class, 'login_page'])->name('login_page');
//***register page***
Route::get('/register', [auth_ctrl::class, 'register_page']);
//***register function***
Route::post('/registertion', [auth_ctrl::class, "signup"])->name('registertion');
//***vrefication email page***
Route::get('/activate_page', [auth_ctrl::class, 'activate_page']);
//*** vrefication email function***
Route::post('/check/code', [auth_ctrl::class, 'activate_email']);
//***loginfunction***
Route::post('/login', [auth_ctrl::class, 'login'])->name('login');
//*** logout function ***/
Route::get('/logout', [auth_ctrl::class, 'logout_fun'])->name('logout');

//end login and register routes
//users routes
Route::get('/', [User_ctrl::class, 'index']);
Route::get('/shipping/form', [User_ctrl::class, 'shipping_from'])->middleware('isuser');
Route::post('/shipping', [User_ctrl::class, 'shipping_data']);
Route::get('/confrmed/{tracking_no}', [User_ctrl::class, 'order_confrmed'])->name('confrmed')->middleware('isuser');
Route::get('/User/Profile/{encrypted_id}', [User_ctrl::class, "user_profile"])->middleware('isuser');
Route::get('/my/order/information/{encrypted_id}', [User_ctrl::class, 'order_details'])->middleware('isuser');
Route::get('/about', [User_ctrl::class, 'about_page']);
Route::get('/tracking/Number', [User_ctrl::class, 'tracking_no_search'])->name('tracking_no_search'); 
Route::get('/supplier/{random_number}',[Suppliers_Ctrl::class,'return_page'])->middleware('isuser');
Route::post('/change/status',[Suppliers_Ctrl::class,'change_statue']);
Route::get('/Suppliers',[Suppliers_Ctrl::class,'suppliers_page']);
Route::get('/Supplier/Profile/{encrypted_id}',[Suppliers_Ctrl::class,'supplier_profile']);
Route::get('/My/Profile/{encrypted_id}',[Suppliers_Ctrl::class,'supplier_profile_supplier_side'])->middleware('isuser');
Route::get('/search/supplier', [Suppliers_Ctrl::class, 'filter_supplier']);
Route::get('/Contact',[User_ctrl::class,'contact_page']);
Route::post('/contact/from',[User_ctrl::class,'sendEmail']);
//end users routes
//admin routes 
Route::group(['middleware' => ['isAdmin'], 'prefix' => 'admin'], function () {
    Route::get('index', [admin_ctrl::class, 'index']);
    Route::get('/show/shipping/details/{encrypted_id}', [admin_ctrl::class, 'show_order_details'])->name('show_order_details');
    Route::post('/add/shipping/status', [admin_ctrl::class, 'add_new_shipping_statue'])->name('add_new_shipping_statue');
    Route::get('/edite/information/{encrypted_id}',[admin_ctrl::class,'edite_shipping_info']);
    Route::post('/update/information',[admin_ctrl::class,'update_shipping_info']);
    Route::get('/Shipping/Orders', [admin_ctrl::class, 'Shipping_Orders'])->name('Shipping_Orders');
    Route::get('/Send/Email/{encrypted_id}', [admin_ctrl::class, 'Send_mail'])->name('Send_mail');
    Route::post('/Send/new/email', [admin_ctrl::class, 'Send_email_fun'])->name('Send_email_fun');
    Route::get('/Emails', [admin_ctrl::class, 'Send_mail2'])->name('Send_mail2');
    Route::get('/user/list', [admin_ctrl::class, 'user_list'])->name('user_list');
    Route::get('/user/details/{encrypted_id}', [admin_ctrl::class, 'user_details'])->name('user_details');
    Route::get('/reports/mails',[admin_ctrl::class,'mail_reports']);
    Route::get('/Staff',[admin_ctrl::class,'stuff_list']);
    Route::get('/reports/Staff',[admin_ctrl::class,'stuff_reports']);
    Route::get('/reports/Staff/details/{encrypted_id}',[admin_ctrl::class,'stuff_details']);
    Route::get('Delete/status/{encrypted_id}',[admin_ctrl::class,'delete_status']);
    Route::post('edite/shipping/status',[admin_ctrl::class,'edite_status']);
    Route::get('/search', [admin_ctrl::class, 'search_admin']);
    Route::get('/shipping/orders/filter',[admin_ctrl::class,'filter_data']);
    Route::get('/request/filter',[Suppliers_Ctrl::class,'filter_data2']);

    Route::get('/delete/shipping/order/{encrypted_id}',[admin_ctrl::class,'delete_order']);
    Route::get('/delete/user/{encrypted_id}',[admin_ctrl::class,'delete_user']);
    Route::get('/delete/user/Staff/{encrypted_id}',[admin_ctrl::class,'delete_user2']);
    Route::get('/delete/mail/{id}', [admin_ctrl::class, 'delete_mail']);
    Route::get('change/status/{encrypted_id}',[admin_ctrl::class,'change_user_to_supplier']);
    Route::get('/Suppliers/List',[Suppliers_Ctrl::class,'suppliers_list']);
    Route::get('/Supplier/Setting/{encrypted_id}',[Suppliers_Ctrl::class,'suppliers_setting']);
    Route::post('/change/setting', [Suppliers_Ctrl::class,'change_setting'])->name('change');
    Route::get('/delete/supplier/photo/{encrypted_id}',[Suppliers_Ctrl::class,'delete_supplier_image']);
    Route::post('/change/permissions/setting',[Suppliers_Ctrl::class,'change_permissions_setting']);
    Route::get('/Add/Request',[Suppliers_Ctrl::class,'add_request']);
    Route::get('/search-customer', [Suppliers_Ctrl::class, 'searchCustomer']);
    Route::get('/search-supplier', [Suppliers_Ctrl::class, 'searchSupplier']);
    Route::post('/add/request',[Suppliers_Ctrl::class,'add_request_function']);
    Route::get('/Suppliers/Requests',[Suppliers_Ctrl::class,'supplier_reqests']);
    Route::post('/update/request/information',[Suppliers_Ctrl::class,'update_request_information']);
    Route::post('/change/staff/Prergations/setting',[admin_ctrl::class,'change_staff_Prergations']);
    Route::get('/supplier/change/status/{encrypted_id}',[admin_ctrl::class,'change_supplier_role_to_user']);
    Route::get('/change/to/support/{encrypted_id}',[admin_ctrl::class,'change_to_support']);

});

//end admin routes