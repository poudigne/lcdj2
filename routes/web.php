<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Models\User;

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

Route::get('/', ['as' => 'public.index', 'uses' => function () {
    return view('accueil');
}]);
Route::get('/Jeux', ['as' => 'public.games', 'uses' => function () {
    return view('jeux');
}]);
Route::get('/Contact', ['as' => 'public.contact', 'uses' => function () {
    return view('contact');
}]);
Route::get('/Cartes', ['as' => 'public.cards', 'uses' => function () {
    return view('cartes');
}]);
Route::get('/Evenement', ['as' => 'public.events', 'uses' => function () {
    return view('events');
}]);


// DASHBOARD 
Route::group(['as' => 'dashboard::','middleware' => 'auth', 'prefix' => 'dashboard'], function () {

    Route::get('/', ['middleware' => 'auth', 'uses' => 'DashboardController@index']);
	Route::get('/home', ['as'=>'home', 'uses' => 'DashboardController@index']);
	//Product
	Route::get('/product/view/{id}', ['middleware' => 'auth', 'uses' => 'ProductController@show']);
	Route::get('/product/create', ['as' => 'product.create', 'middleware' => 'auth', 'uses' => 'ProductController@create']);
	Route::post('/product/create', ['as' => 'product.create.post', 'middleware' => 'auth', 'uses' => 'ProductController@store']);
    Route::get('/product/edit/{id}', ['as' => 'product.edit', 'middleware' => 'auth', 'uses' => 'ProductController@edit']);
    Route::post('/product/delete/media', ['as' => 'product.delete.media.post', 'middleware' => 'auth', 'uses' => 'ProductController@delete_media']);
    Route::post('/product/edit/{id}', ['as' => 'product.edit.post', 'middleware' => 'auth', 'uses' => 'ProductController@update']);
	Route::get('/product', ['as' => 'product.show', 'middleware' => 'auth', 'uses' => 'ProductController@index']);
	Route::post("/product/delete", ['as' => 'product.delete.post', 'middleware' => 'auth', 'uses' => 'ProductController@multiple_delete']);

    Route::post("/product/publish", ['as' => 'product.publish.post', 'middleware' => 'auth', 'uses' => 'ProductController@multiple_publish']);
    Route::post("/product/unpublish", ['as' => 'product.unpublish.post', 'middleware' => 'auth', 'uses' => 'ProductController@multiple_unpublish']);

	//Category
	Route::get('/category/create', ['as' => 'category.create', 'middleware' => 'auth', 'uses' => 'CategoryController@create']);
	Route::post('/category/create', ['as' => 'category.create.post', 'middleware' => 'auth', 'uses' => 'CategoryController@store']);
    Route::get('/category/edit/{id}', ['as' => 'category.edit', 'middleware' => 'auth', 'uses' => 'CategoryController@edit']);
    Route::post('/category/edit/{id}', ['as' => 'category.edit.post', 'middleware' => 'auth', 'uses' => 'CategoryController@update']);
	Route::get('/category', ['as' => 'category.show', 'middleware' => 'auth', 'uses' => 'CategoryController@index']);
    Route::post("/category/delete", ['as' => 'category.delete.post', 'middleware' => 'auth', 'uses' => 'CategoryController@multiple_delete']);

    Route::post("/category/publish", ['as' => 'category.publish.post', 'middleware' => 'auth', 'uses' => 'CategoryController@multiple_publish']);
    Route::post("/category/unpublish", ['as' => 'category.unpublish.post', 'middleware' => 'auth', 'uses' => 'CategoryController@multiple_unpublish']);

	// News
	Route::get('/news', ['as' => 'news.show', 'middleware' => 'auth', 'uses' => 'NewsController@index']);
    Route::get('/news/create', ['as' => 'news.create', 'middleware' => 'auth', 'uses' => 'NewsController@create']);
    Route::post('/news/create', ['as' => 'news.create.post', 'middleware' => 'auth', 'uses' => 'NewsController@store']);
    Route::get('/news/edit/{id}', ['as' => 'news.edit', 'middleware' => 'auth', 'uses' => 'NewsController@edit']);
    Route::post('/news/edit/{id}', ['as' => 'news.edit.post', 'middleware' => 'auth', 'uses' => 'NewsController@update']);

    Route::post("/news/delete", ['as' => 'news.delete.post', 'middleware' => 'auth', 'uses' => 'NewsController@multiple_delete']);

    Route::post("/news/publish", ['as' => 'news.publish.post', 'middleware' => 'auth', 'uses' => 'NewsController@multiple_publish']);
    Route::post("/news/unpublish", ['as' => 'news.unpublish.post', 'middleware' => 'auth', 'uses' => 'NewsController@multiple_unpublish']);

    // Inventory
	Route::get('/inventory', [InventoryController::class, 'index'])
            ->middleware('auth')
            ->name('inventory.show');
    Route::get('/inventory/search', [InventoryController::class, 'index'])
            ->middleware('auth')
            ->name('inventory.search');
    Route::get('/inventory/sort/{sorttype}',  [InventoryController::class, 'sort'])
            ->middleware('auth')
            ->name('inventory.sort');
    Route::post('/inventory/search', [InventoryController::class, 'search'])
            ->middleware('auth')
            ->name('inventory.search.post');
    Route::post('/inventory/increase', [InventoryController::class, 'increase'])
            ->middleware('auth')
            ->name('inventory.inc.post');
    Route::post('/inventory/decrease', [InventoryController::class, 'decrease'])
            ->middleware('auth')
            ->name('inventory.dec.post');

    // Event
    Route::get('/event', ['as' => 'event.show', 'middleware' => 'auth', 'uses' => 'EventController@index']);

    Route::post("/event/delete", ['as' => 'event.delete.post', 'middleware' => 'auth', 'uses' => 'EventController@multiple_delete']);

    Route::get('/event/create', ['as' => 'event.create', 'middleware' => 'auth', 'uses' => 'EventController@create']);
    Route::post('/event/create', ['as' => 'event.create.post', 'middleware' => 'auth', 'uses' => 'EventController@store']);

    Route::get('/event/edit/{id}', ['as' => 'event.edit', 'middleware' => 'auth', 'uses' => 'EventController@edit']);
    Route::post('/event/edit/{id}', ['as' => 'event.edit.post', 'middleware' => 'auth', 'uses' => 'EventController@update']);

    Route::post("/event/publish", ['as' => 'event.publish.post', 'middleware' => 'auth', 'uses' => 'EventController@multiple_publish']);
    Route::post("/event/unpublish", ['as' => 'event.unpublish.post', 'middleware' => 'auth', 'uses' => 'EventController@multiple_unpublish']);


    // receipt
    Route::get('/sale', ['as' => 'sale.show', 'middleware' => 'auth', 'uses' => 'SaleController@index']);
    Route::post("/sale/delete", ['as' => 'sale.delete.post', 'middleware' => 'auth', 'uses' => 'SaleController@multiple_delete']);
    Route::post("/sale/delete", ['as' => 'sale.delete.post', 'middleware' => 'auth', 'uses' => 'SaleController@multiple_delete']);
    Route::get('/sale/create', ['as' => 'sale.create', 'middleware' => 'auth', 'uses' => 'SaleController@create']);
    Route::post('/sale/create', ['as' => 'sale.create.post', 'middleware' => 'auth', 'uses' => 'SaleController@store']);
    Route::get('/sale/delete/{id}', ['as' => 'sale.delete', 'middleware' => 'auth', 'uses' => 'SaleController@destroy']);

});

Route::get("/CreateShenrokCredential", function(){
    return User::create([
           'name' => 'Marc cantin',
           'email' => 'shenrok@lcdj.com',
           'password' => bcrypt('test123'),
       ]);
});

require __DIR__.'/auth.php';