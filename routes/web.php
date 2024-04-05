<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;  
use Illuminate\Support\Facades\App;
use App\Models\products;
use App\Models\ProductDetails;



// the user must log in 
Route::get('/', function () {
    return view('welcome');
})->middleware('auth');



Auth::routes();
Route::get('/dashboard', [Dashboard::class, 'index'])->name('index');

//products page
//Route::get('/dashboard/products', [Dashboard::class, 'GetProducts'])->name('products');

Route::post('/dashboard/createproduct', [Dashboard::class, 'CreateProducts'])->name('create-product');

Route::post('/product/createProducts', [Dashboard::class, 'CreateProducts'])->name('createproducts');

Route::get('/test', [Dashboard::class, 'test'])->name('test');

Route::get('/logout', [Dashboard::class, 'logout'])->name('logout');


Route::get('/dashboard/getProductDetails', [Dashboard::class, 'getProductDetails'])->name('Product-Details');

Route::post('/dashboard/createproductsdetails', [Dashboard::class, 'createProductDetails'])->name('create-details');

//  route for the search 
//Route::get('/dashboard/searchProducts', [Dashboard::class, 'searchProducts'])->name('search-products');

// route fro show all product 
Route::get('/dashboard/allProducts', [Dashboard::class, 'allProducts'])->name('all-products');

// route for search and read 
Route::get('/dashboard/products', [Dashboard::class, 'GetProducts'])->name('get-products');


// route for the edit 
// Show the form for editing a product
Route::get('/dashboard/editProduct/{id}', [Dashboard::class, 'showEditProductForm'])->name('show-edit-product-form');

// Handle the form submission for editing a product
Route::post('/dashboard/editProduct/{id}', [Dashboard::class, 'editProduct'])->name('edit-product');

//  route for the delete 
Route::delete('/dashboard/deleteProduct/{id}', [Dashboard::class, 'deleteProduct'])->name('delete-product');

// route for the details functionality
Route::get('/dashboard/getProductDetails/{id}', [Dashboard::class, 'getProductDetails'])->name('product-details');

// route for the details
Route::post('/dashboard/createproductdetails', [Dashboard::class, 'createProductDetails'])->name('create-product-details');

// This route displays the form to edit product details
Route::get('/product/{id}/edit', [Dashboard::class, 'showEditDetailsProductForm'])->name('edit-product-details-form');

// This route handles the form submission to update the product details
Route::post('/product/{id}/edit', [Dashboard::class, 'editProductDetails'])->name('edit-product-details');

//route for languages in App config
/*Route::get('language/{locale}', function ($locale) {
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});
*/

Route::get('language/{locale}', [Dashboard::class, 'setLocale']);


Route::get('/', [HomeController::class, 'index']);


