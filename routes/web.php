<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SaleController;
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

    Route::get('/', [DashboardController::class, 'index'])
        ->middleware('auth');
	Route::get('/home', [DashboardController::class, 'index'])
        ->name('home');
	//Product
	Route::get('/product/view/{id}', [ProductController::class, 'show'])
        ->middleware('auth')
        ->name('product.create');
	Route::get('/product/create', [ProductController::class, 'create'])
    ->name('product.create')
    ->middleware('auth');
	Route::post('/product/create', [ProductController::class, 'store'])
    ->name('product.create.post')
    ->middleware('auth');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])
    ->name('product.edit')
    ->middleware('auth');
    Route::post('/product/delete/media', [ProductController::class, 'delete_media'])
    ->name('product.delete.media.post')
    ->middleware('auth');
    Route::post('/product/edit/{id}', [ProductController::class, 'update'])
    ->name('product.edit.post')
    ->middleware('auth');
	Route::get('/product', [ProductController::class, 'index'])
    ->name('product.show')
    ->middleware('auth');
	Route::post("/product/delete", [ProductController::class, 'multiple_delete'])
    ->name('product.delete.post')
    ->middleware('auth');

    Route::post("/product/publish",[ProductController::class, 'multiple_publish'])
    ->name('product.publish.post')
    ->middleware('auth');
    Route::post("/product/unpublish", [ProductController::class, 'multiple_unpublish'])
    ->name('product.unpublish.post')
    ->middleware('auth');
	//Category
	Route::get('/category/create', [CategoryController::class, 'create'])
    ->name('category.create')
    ->middleware('auth');
	Route::post('/category/create', [CategoryController::class, 'store'])
    ->name('category.create.post')
    ->middleware('auth');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])
    ->name('category.edit')
    ->middleware('auth');
    Route::post('/category/edit/{id}', [CategoryController::class, 'update'])
    ->name('category.edit.post')
    ->middleware('auth');
	Route::get('/category', [CategoryController::class, 'index'])
    ->name('category.show')
    ->middleware('auth');
    Route::post("/category/delete", [CategoryController::class, 'multiple_delete'])
    ->name('category.delete.post')
    ->middleware('auth');

    Route::post("/category/publish", [CategoryController::class, 'multiple_publish'])
    ->name('category.publish.post')
    ->middleware('auth');
    Route::post("/category/unpublish", [CategoryController::class, 'multiple_unpublish'])
    ->name('category.unpublish.post')
    ->middleware('auth');

	// News
	Route::get('/news', [NewsController::class, 'index'])
    ->name('news.show')
    ->middleware('auth');
    Route::get('/news/create', [NewsController::class, 'create'])
    ->name('news.create')
    ->middleware('auth');
    Route::post('/news/create', [NewsController::class, 'store'])
    ->name('news.create.post')
    ->middleware('auth');
    Route::get('/news/edit/{id}', [NewsController::class, 'edit'])
    ->name('news.edit')
    ->middleware('auth');
    Route::post('/news/edit/{id}', [NewsController::class, 'update'])
    ->name('news.edit.post')
    ->middleware('auth');

    Route::post("/news/delete", [NewsController::class, 'multiple_delete'])
    ->name('news.delete.post')
    ->middleware('auth');

    Route::post("/news/publish", [NewsController::class, 'multiple_publish'])
    ->name('news.publish.post')
    ->middleware('auth');
    Route::post("/news/unpublish", [NewsController::class, 'multiple_unpublish'])
    ->name('news.unpublish.post')
    ->middleware('auth');

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
    Route::get('/event', [EventController::class, 'index'])
        ->middleware('auth')
        ->name('event.show');

    Route::post("/event/delete", [EventController::class, 'multiple_delete'])
        ->middleware('auth')
        ->name('event.delete.post');

    Route::get('/event/create', [EventController::class, 'create'])
        ->middleware('auth')
        ->name('event.create');
    Route::post('/event/create', [EventController::class, 'store'])
        ->middleware('auth')
        ->name('event.create.post');

    Route::get('/event/edit/{id}', [EventController::class, 'edit'])
        ->middleware('auth')
        ->name('event.edit');
    Route::post('/event/edit/{id}', [EventController::class, 'update'])
        ->middleware('auth')
        ->name('event.edit.post');

    Route::post("/event/publish", [EventController::class, 'multiple_publish'])
        ->middleware('auth')
        ->name('event.publish.post');
    Route::post("/event/unpublish", [EventController::class, 'multiple_unpublish'])
        ->middleware('auth')
        ->name('event.unpublish.post');


    // receipt
    Route::get('/sale', [SaleController::class, 'index'])
        ->middleware('auth')
        ->name('sale.show');
    Route::post("/sale/delete", [SaleController::class, 'multiple_delete'])
        ->middleware('auth')
        ->name('sale.delete.post');
    Route::get('/sale/create', [SaleController::class, 'create'])
        ->middleware('auth')
        ->name('sale.create');
    Route::post('/sale/create', [SaleController::class, 'store'])
        ->middleware('auth')
        ->name('sale.create.post');
    Route::get('/sale/delete/{id}', [SaleController::class, 'destroy'])
        ->middleware('auth')
        ->name('sale.delete');

});

Route::get("/CreateShenrokCredential", function(){
    return User::create([
           'name' => 'dummy user',
           'email' => 'dummy@lcdj.com',
           'password' => bcrypt('test123'),
       ]);
});

require __DIR__.'/auth.php';