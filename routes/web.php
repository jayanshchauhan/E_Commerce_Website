<?php

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

Route::get('/', 'Frontend\UserController@show');

Auth::routes();

Route::get('collections', 'Frontend\CollectionController@index');
Route::get('allproducts', 'Frontend\CollectionController@show');
Route::get('details/{prod_url}', 'Frontend\CollectionController@views');

//Frontend

Route::get('/searchproducts', 'Frontend\UserController@searchAutoComplete')->name('searchproductajax');
Route::post('/searching', 'Frontend\UserController@result');

Route::get('collection/{group_url}', 'Frontend\CollectionController@groupView');
Route::get('collection/{group_url}/{cate_url}', 'Frontend\CollectionController@categoryView');
Route::get('collection/{group_url}/{cate_url}/{subcate_url}', 'Frontend\CollectionController@subCategoryView');
Route::get('collection/{group_url}/{cate_url}/{subcate_url}/{prod_url}', 'Frontend\CollectionController@productView');

Route::get('clear-cart', 'Frontend\CartController@clearCart');
Route::delete('delete-from-cart', 'Frontend\CartController@deleteFromCart');
Route::post('update-to-cart', 'Frontend\CartController@updateToCart');
Route::get('/cart', 'Frontend\CartController@index');
Route::get('/load-cart-data', 'Frontend\CartController@cartloadByAjax');
Route::post('add-to-cart', 'Frontend\CartController@addToCart');

//For User

Route::group(['middleware' => ['auth', 'isuser']], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/my-profile', 'Frontend\UserController@myprofile');
    Route::get('/my-order/{id}', 'Frontend\UserController@myorder');
    Route::put('/my_profile_update', 'Frontend\UserController@profileupdate');

    Route::get('checkout', 'Frontend\CheckoutController@index');
    Route::post('place-order', 'Frontend\CheckoutController@store');
});

//For Admin

Route::group(['middleware' => ['auth', 'isadmin']], function () {

    Route::get('/dashboard', 'Admin\GroupController@show');

    Route::get('registered-user', 'Admin\RegisteredController@index');
    Route::get('role-edit/{id}', 'Admin\RegisteredController@edit');
    Route::put('role-update/{id}', 'Admin\RegisteredController@updaterole');
    Route::put('/my-profile-update', 'Frontend\UserController@profileupdate');
    Route::get('role-delete/{id}', 'Admin\RegisteredController@delete');

    //Groups
    Route::get('group', 'Admin\GroupController@index');
    Route::get('group-add', 'Admin\GroupController@viewpage');
    Route::post('group-store', 'Admin\GroupController@store');
    Route::get('group-edit/{id}', 'Admin\GroupController@edit');
    Route::put('group-update/{id}', 'Admin\GroupController@update');
    Route::get('group-delete/{id}', 'Admin\GroupController@delete');

    //Category
    Route::get('category', 'Admin\CategoryController@index');
    Route::get('category-add', 'Admin\CategoryController@create');
    Route::post('category-store', 'Admin\CategoryController@store');
    Route::get('category-edit/{id}', 'Admin\CategoryController@edit');
    Route::put('category-update/{id}', 'Admin\CategoryController@update');
    Route::get('category-delete/{id}', 'Admin\CategoryController@delete');

    //Sub Category
    Route::get('sub-category', 'Admin\SubCategoryController@index');
    Route::post('sub-category-store', 'Admin\SubCategoryController@store');
    Route::get('sub-category-edit/{id}', 'Admin\SubCategoryController@edit');
    Route::put('sub-category-update/{id}', 'Admin\SubCategoryController@update');
    Route::get('sub-category-delete/{id}', 'Admin\SubCategoryController@delete');

    //Product
    Route::get('products', 'Admin\ProductsController@index');
    Route::get('product-add', 'Admin\ProductsController@create');
    Route::post('product-store', 'Admin\ProductsController@store');
    Route::get('product-edit/{id}', 'Admin\ProductsController@edit');
    Route::put('product-update/{id}', 'Admin\ProductsController@update');
    Route::get('product-delete/{id}', 'Admin\ProductsController@delete');
});
