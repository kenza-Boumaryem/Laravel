<?php

use Illuminate\Support\Facades\Route;
//importer les controlleur qui sont dans http/controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


route::get('/',[HomeController::class,'index']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
});
//the name of the function would be redirect
//we added here a route for the url redirect(li kayn fProviders/routeservice)
route::get('/redirect',[HomeController::class,'redirect'])->middleware('auth','verified');
route::get('/view_category',[AdminController::class,'view_category']);
//ajouter une route pour l'url add_category qui se trouve dans category.blade.php
//dans category.blade.php on a mentionee que l'action est post donc au lieu d'ecrire get on va ecrire post
route::post('/add_category',[AdminController::class,'add_category']);
//ajouter une route pour l'url delete_category qui se trouve dans category.blade.php
route::get('/delete_category/{id}',[AdminController::class,'delete_category']);
//ajouter une route pour l'url view_product qui se trouve dans sidebar.blade.php
route::get('/view_product',[AdminController::class,'view_product']);
//ajouter une route pour l'url view_product qui se trouve dans product.blade.php
route::post('/add_product',[AdminController::class,'add_product']);
//ajouter une route pour l'url show_product qui se trouve dans sidebar.blade.php
route::get('/show_product',[AdminController::class,'show_product']);
//ajouter une route pour l'url delete_product qui se trouve dans show_product.blade.php
route::get('/delete_product/{id}',[AdminController::class,'delete_product']);
//ajouter une route pour l'url update_product qui se trouve dans show_product.blade.php
route::get('/update_product/{id}',[AdminController::class,'update_product']);
//ajouter une route pour l'url update_product_confirm qui se trouve dans update_product.blade.php
route::post('/update_product_confirm/{id}',[AdminController::class,'update_product_confirm']);

//ajouter une route pour l'url order qui se trouve dans sidebar.blade.php
route::get('/order',[AdminController::class,'order']);
//ajouter une route pour l'url delivered qui se trouve dans order.blade.php
route::get('/delivered/{id}',[AdminController::class,'delivered']);
//ajouter une route pour l'url print_pdf qui se trouve dans order.blade.php
route::get('/print_pdf/{id}',[AdminController::class,'print_pdf']);
//ajouter une route pour l'url send_email qui se trouve dans order.blade.php
route::get('/send_email/{id}',[AdminController::class,'send_email']);
//ajouter une route pour l'url send_user_email qui se trouve dans email_info.blade.php
route::post('/send_user_email/{id}',[AdminController::class,'send_user_email']);
//ajouter une route pour l'url search qui se trouve dorder.blade.php
route::get('/search',[AdminController::class,'searchdata']);
//ajouter une route pour l'url message qui se trouve sidebar.blade.php
route::get('/message',[AdminController::class,'message']);
//ajouter une route pour l'url send_email_message qui se trouve message.blade.php
route::get('/send_email_message/{id}',[AdminController::class,'send_email_message']);
//ajouter une route pour l'url send_user_email_message qui se trouve dans email_info_message.blade.php
route::post('/send_user_email_message/{id}',[AdminController::class,'send_user_email_message']);
route::get('/utilisateur',[AdminController::class,'utilisateur']);
route::get('/delete_user/{id}',[AdminController::class,'delete_user']);
route::get('/qr_code',[HomeController::class,'qr_code']);
route::get('/shop',[HomeController::class,'shop']);
route::post('/deletenotif',[AdminController::class,'deletenotif'])->name('deletenotif');




//ajouter une route pour l'url product_detail qui se trouve dans product.blade.php
route::get('/product_detail/{id}',[HomeController::class,'product_detail']);
//ajouter une route pour l'url add_cart qui se trouve dans product.blade.php
route::post('/add_cart/{id}',[HomeController::class,'add_cart']);
//ajouter une route pour l'url show_cart qui se trouve dans header.blade.php
route::get('/show_cart',[HomeController::class,'show_cart']);
//ajouter une route pour l'url remove_cart qui se trouve dans showcart.blade.php
route::get('/remove_cart/{id}',[HomeController::class,'remove_cart']);
//ajouter une route pour l'url cash_order qui se trouve dans showcart.blade.php
route::get('/cash_order',[HomeController::class,'cash_order']);
//ajouter une route pour l'url stripe qui se trouve dans showcart.blade.php
route::get('/stripe/{totalprice}',[HomeController::class,'stripe']);
//in stripe .blade.php the route name is stripe.post but the url is stripe
Route::post('stripe/{totalprice}', [HomeController::class,'stripePost'])->name('stripe.post');
//ajouter une route pour l'url show_order qui se trouve dans header.blade.php
route::get('/show_order',[HomeController::class,'show_order']);
//ajouter une route pour l'url cancel_order qui se trouve dans order.blade.php
route::get('/cancel_order/{id}',[HomeController::class,'cancel_order']);
//ajouter une route pour l'url add_comment qui se trouve dans userpage.blade.php
route::post('/add_comment',[HomeController::class,'add_comment']);
//ajouter une route pour l'url add_reply qui se trouve dans userpage.blade.php
route::post('/add_reply',[HomeController::class,'add_reply']);
//ajouter une route pour l'url contacter qui se trouve dans userpage.blade.php
route::get('/contacter',[HomeController::class,'contacter']);
//ajouter une route pour l'url product_search qui se trouve dans product.blade.php
route::get('/product_search',[HomeController::class,'product_search']);
//ajouter une route pour l'url products qui se trouve dans header.blade.php
route::get('/products',[HomeController::class,'product']);
//ajouter une route pour l'url search_product qui se trouve dans product_view.blade.php
route::get('/search_product',[HomeController::class,'search_product']);
//ajouter une route pour l'url contacter qui se trouve dans contact.blade.php
route::post('/contact_util',[HomeController::class,'contact_util']);
//ajouter une route pour l'url subscribe qui se trouve dans subscribe.blade.php
route::post('/sub',[HomeController::class,'subscribe']);
//ajouter une route pour l'url send_subsc qui se trouve dans sidebar.blade.php
route::get('/send_subsc',[AdminController::class,'send_subsc']);
//ajouter une route pour l'url send_subsc qui se trouve dans sidebar.blade.php
route::get('/send_email_subscriber/{id}',[AdminController::class,'send_email_subscriber']);
//ajouter une route pour l'url send_subsc qui se trouve dans sidebar.blade.php
route::post('/send_user_email_sub/{id}',[AdminController::class,'send_user_email_sub']);
//ajouter une route pour l'url send_subsc qui se trouve dans sidebar.blade.php
route::get('/delete_message/{id}',[AdminController::class,'delete_message']);