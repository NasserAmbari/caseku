<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsLogged;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperUserController;
use App\Http\Controllers\ListProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManualOrderController;
use App\Http\Controllers\ManualOrderItemController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([IsLogged::class])->group(function(){
    Route::prefix('v1/admin')->group(function(){

        Route::get('/',[AdminController::class,'homePage'])->name('admin');
    
    });
});


Route::middleware([IsLogged::class])->group(function(){
    Route::prefix('v1/superuser')->group(function () {

        Route::get('/',[SuperUserController::class,'homePage'])->name('superUser');
        
        Route::prefix('/listphonebrand')->group(function(){
            Route::get('/',[ListProductController::class,'ListPhonePage'])->name('listPhoneBrand');
            Route::post('/storedata',[ListProductController::class,'StoreBrandPhoneData'])->name('storePhoneBrandData');
            Route::get('/geteditdata/{id?}',[ListProductController::class,'GetEditPhoneBrandData'])->name('getEditPhoneBrandData');
            Route::patch('/updatedata',[ListProductController::class,'UpdatePhoneBrandData'])->name('updatePhoneBrandType');
            Route::delete('/deletedata',[ListProductController::class,'DeletePhoneBrandData'])->name('deletePhoneBrandData');
        });

        Route::prefix('/listcase')->group(function(){
            Route::get('/',[ListProductController::class,'ListCasePage'])->name('listCaseType');
            Route::post('/storedata',[ListProductController::class,'StoreCaseData'])->name('storeCaseData');
            Route::get('/geteditdata/{id?}',[ListProductController::class,'GetEditCaseData'])->name('getEditCaseData');
            Route::patch('/updatedata',[ListProductController::class,'UpdateListCaseData'])->name('updateCaseType');
            Route::delete('/deletedata',[ListProductController::class,'DeleteCaseData'])->name('deleteCaseData');
        });

        Route::prefix('/listphonetype')->group(function(){
            Route::get('/',[ListProductController::class,'ListPhoneTypePage'])->name('listPhoneType');
            Route::post('/storedata',[ListProductController::class,'StorePhoneTypeData'])->name('storePhoneTypeData');
            Route::get('/geteditdata/{id?}',[ListProductController::class,'GetEditPhoneTypeData'])->name('getEditPhoneTypeData');
            Route::patch('/updatedata',[ListProductController::class,'UpdateListPhoneTypeData'])->name('updatePhoneTypeData');
            Route::delete('/deletedata',[ListProductController::class,'DeletePhoneTypeData'])->name('deletePhoneTypeData');
        });

        Route::prefix('/stockproduct')->group(function(){
            Route::get('/',[ListProductController::class,'ListStockProductPage'])->name('listStockProduct');
            Route::post('/storedata',[ListProductController::class,'StoreStockProductData'])->name('storeStockProductData');
            Route::get('/gettypephone/{id?}',[ListProductController::class,'GetTypePhone'])->name('getTypePhone');
            Route::get('/geteditdata/{id?}',[ListProductController::class,'GetEditStockProductData'])->name('getEditStockProductData');
            Route::patch('/updatedata',[ListProductController::class,'UpdateStockProductData'])->name('updateStockProductData');
            Route::delete('/deletedata',[ListProductController::class,'DeleteStockProductData'])->name('deleteStockProductData');
        });

        Route::prefix('/users')->group(function(){
            Route::get('/',[UserController::class,'ListUser'])->name('listUser');
            Route::post('/storedata',[UserController::class,'StoreUserData'])->name('storeUserData');
            Route::get('/geteditdata/{id?}',[UserController::class,'GetEditUserData'])->name('getEditUserData');
            Route::patch('/updatedata/{id?}',[UserController::class,'UpdateUserData'])->name('updateUserData');
            Route::delete('/deletedata',[UserController::class,'DeleteUserData'])->name('deleteUserData');
        });

        Route::prefix('/ordersource')->group(function(){
            Route::get('/',[OrderController::class,'ListOrderSource'])->name('listOrderSource');
            Route::post('/storedata',[OrderController::class,'StoreOrderSourceData'])->name('storeSourceOrderData');
            Route::get('/geteditdata/{id?}',[OrderController::class,'GetEditSourceOrderData'])->name('getEditSourceOrderData');
            Route::patch('/updatedata/{id?}',[OrderController::class,'UpdateSourceOrderData'])->name('updateSourceOrderData');
            Route::delete('/deletedata',[OrderController::class,'DeleteSourceOrderData'])->name('deleteSourceOrderData');
        });

        Route::prefix('/shippingmethod')->group(function(){
            Route::get('/',[OrderController::class,'ListShippingMethod'])->name('listShippingMethod');
            Route::post('/storedata',[OrderController::class,'StoreShippingMethodData'])->name('storeShippingMethodData');
            Route::get('/geteditdata/{id?}',[OrderController::class,'GetEditShippingMethodData'])->name('getEditShippingMethodData');
            Route::patch('/updatedata/{id?}',[OrderController::class,'UpdateShippingMethodData'])->name('updateShippingMethodData');
            Route::delete('/deletedata',[OrderController::class,'DeleteShippingMethodData'])->name('deleteShippingMethodData');
        });

        Route::prefix('/paymenymethod')->group(function(){
            Route::get('/',[OrderController::class,'ListPaymentMethod'])->name('listPaymentMethod');
            Route::post('/storedata',[OrderController::class,'StorePaymentMethodData'])->name('storePaymentMethodData');
            Route::get('/geteditdata/{id?}',[OrderController::class,'GetEditPaymentMethodData'])->name('getEditPaymentMethodData');
            Route::patch('/updatedata/{id?}',[OrderController::class,'UpdatePaymentMethodData'])->name('updatePaymentMethodData');
            Route::delete('/deletedata',[OrderController::class,'DeletePaymentMethodData'])->name('deletePaymentMethodData');
        });

        Route::prefix('/manualorder')->group(function(){
            Route::get('/',[ManualOrderController::class,'ListManualOrder'])->name('listManualOrder');
            Route::post('/storedata',[ManualOrderController::class,'StoreManualOrderData'])->name('storeManualOrderData');
            Route::get('/geteditdata/{id?}',[ManualOrderController::class,'GetManualOrderData'])->name('getEditManualOrderData');
            Route::patch('/updatedata',[ManualOrderController::class,'UpdateManualOrderData'])->name('updateManualOrderData');
            Route::patch('/updatestatusorder',[ManualOrderController::class,'UpdateManualStatusOrderData'])->name('updateManualStatusOrderData');
            Route::delete('/deletedata',[ManualOrderController::class,'DeleteManualOrderData'])->name('deleteManualOrderData');

            Route::prefix('/item')->group(function(){
                Route::get('/{id}',[ManualOrderItemController::class,'ListOrderManualItem'])->name('listOrderManualItem');
                Route::post('/checkitem',[ManualOrderItemController::class,'CheckItem'])->name('checkItem');
                Route::post('/storedata',[ManualOrderItemController::class,'StoreManualOrderItemData'])->name('storeManualOrderItemData');
                Route::delete('/deletedata',[ManualOrderItemController::class,'DeleteManualOrderItemData'])->name('deleteManualOrderItemData');
                Route::get('/getstatusitem/{id?}',[ManualOrderItemController::class,'GetStatusItem'])->name('getStatusItem');
                Route::patch('/updatestatusitem',[ManualOrderItemController::class,'UpdateStatusDataItem'])->name('updateStatusDataItem');
            });
        });

        Route::prefix('/print')->group(function(){
            Route::get('/ordermanual/{id}',[ManualOrderController::class,'PrintManualOrder'])->name('printManualOrder');
        });
    });
});


Route::prefix('v1/auth')->group(function () {
    Route::get('/login',[AuthController::class, 'loginPage'])->name('login')->middleware('alreadyLogin');
    Route::post('/checkauth',[AuthController::class, 'checkAuth'])->name('authCheck');
    Route::get('/logout', [AuthController::class,'logout'])->name('logout');
});

