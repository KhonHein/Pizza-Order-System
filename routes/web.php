<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use PharIo\Manifest\AuthorCollectionIterator;


Route::middleware(['admin_auth'])->group(function () {
    //login ,register
Route::redirect('/', 'loginPage');
Route::get('loginPage',[AuthController::class,'loginPage'])->name('admin#loginPage');
Route::get('registerPage',[AuthController::class,'registerPage'])->name('admin#registerPage');
});

//dashboard
Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

//admin
Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin_auth'])->group(function(){
        //category/list
        Route::prefix('category')->group(function(){
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
            Route::post('update',[CategoryController::class,'update'])->name('category#update');
        });

        //admin account
        Route::prefix('admin')->group(function(){
            //password
            Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changePassword');

            //profile
            Route::get('deteils',[AdminController::class,'details'])->name('admin#details');
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
            Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');

            //admin list
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            //delete admin
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            // delete user with Ajax method
            Route::get('deleteUser', [AdminController::class, 'deleteUser'])->name('admin#deleteUser');
            //changeRole
            Route::get('changeRole',[AdminController::class,'changeRole'])->name('admin#changeRole');
            //order
            Route::prefix('order')->group(function () {
                Route::get('list', [OrderController::class, 'orderList'])->name('admin#orderList');
                Route::get('select/status', [OrderController::class, 'orderStatus'])->name('admin#orderStatus');
                Route::get('ajax/change/status', [OrderController::class, 'changeStatus'])->name('admin#ajaxChangeStatus');
                Route::get('info/{roderCode}', [OrderController::class, 'orderInfo'])->name('order#info');
            });

            //user list
            Route::prefix('user')->group(function () {
                Route::get('list', [UserController::class, 'userList'])->name('admin#userList');
                Route::get('change/role',[UserController::class,'changeRole'])->name('user#changeRole');

            });
        });


        //products
        Route::prefix('products')->group(function(){
            Route::get('list',[ProductController::class,'list'])->name('products#list');
            Route::get('create',[ProductController::class,'createPage'])->name('products#createPage');
            Route::post('create',[ProductController::class,'create'])->name('products#create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('products#delete');
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('products#edit');
            Route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('products#updatePage');
            Route::post('update',[ProductController::class,'update'])->name('products#update');
        });

        //contact message
        Route::prefix('message')->group(function () {
            Route::get('sms/list', [ContactController::class, 'messageList'])->name('admin#messageList');
            Route::get('sms/delete', [ContactController::class, 'deleteMessage'])->name('admin#deleteMessage');
        });


    });

    //user/home
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
        //user home
        Route::get('/homePage',[UserController::class,'homePage'])->name('user#home');
        Route::get('/filter{categoryId}',[UserController::class,'filter'])->name('user#filter');
        Route::get('/history', [UserController::class, 'history'])->name('user#history');

        //password
        Route::prefix('password')->group(function(){
            Route::get('change',[UserController::class,'changePasswordPage'])->name('change#passwordPage');
            Route::post('change',[UserController::class,'changePassword'])->name('change#password');
        });

        //profile
        Route::prefix('profile')->group(function(){
            Route::get('change',[UserController::class,'accoutnChangePage'])->name('change#page');
            Route::post('change',[UserController::class,'accoutnChange'])->name('account#page');
        });

        //ajax
        Route::prefix('ajax')->group(function(){
            Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
            Route::get('addCart',[AjaxController::class,'addCart'])->name('ajax#addCart');
            Route::get('order', [AjaxController::class, 'order'])->name('ajax#order');
            Route::get('clear/cart', [AjaxController::class, 'clearCart'])->name('ajax#clearCart');
            Route::get('clear/currProduct', [AjaxController::class, 'clearCurrProduct'])->name('ajax#clearCurrProduct');
            Route::get('increase/viewsCount', [AjaxController::class, 'viewsCount'])->name('ajax#increaseViewCout');
        });

        //details
        Route::prefix('pizza')->group(function(){
            Route::get('pizza/details/{id}',[UserController::class,'pizzaDetails'])->name('userPizza#details');
        });

        //carts
         Route::prefix('cart')->group(function(){
            Route::get('list',[UserController::class,'cartList'])->name('cart#list');
        });

        // contact
        Route::prefix('contact')->group(function(){
            Route::get('toAdmin',[ContactController::class,'contactToAdimn'])->name('user#contactToAdimn');
            Route::post('sendToAdmin', [ContactController::class, 'sendToAdimn'])->name('user#sendToAdmin');
        });
    });
});


