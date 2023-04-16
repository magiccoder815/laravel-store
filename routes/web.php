<?php

use App\Http\Controllers\Main\CartController;
use App\Http\Controllers\Main\GoodController;
use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\Main\ProfileController;
use Illuminate\Support\Facades\Route;

Route::controller(IndexController::class)->group(function () {
    Route::get('', 'dashboard')->name('index.dashboard');
    Route::get('category/{category}', 'category')->name('index.category');
});

Route::prefix('goods')->controller(GoodController::class)->group(function () {
    Route::get('search', 'search')->name('goods.search');
    Route::get('{category}', 'goods')->name('goods.index');
    Route::get('{good}/general', 'index')->name('goods.good.general');
    Route::get('{good}/properties', 'properties')->name('goods.good.properties');
    Route::get('{good}/reviews', 'reviews')->name('goods.good.reviews');
});

Route::prefix('cart')->controller(CartController::class)->group(function () {
    Route::post('store/{good}', 'store')->name('cart.store');
    Route::patch('update/{good}', 'update')->name('cart.update');
    Route::delete('delete/{good}', 'delete')->name('cart.delete');
    Route::delete('bulk-delete', 'bulkDelete')->name('cart.bulk-delete');
});

Route::prefix('profile')->controller(ProfileController::class)->middleware('auth')->group(function () {
    Route::get('personal-information', 'edit')->name('profile.personal-information.edit');
    Route::patch('personal-information', 'update')->name('profile.personal-information.update');
    Route::delete('personal-information', 'destroy')->name('profile.personal-information.destroy');
    Route::post('address', 'storeAddress')->name('profile.address.store');
    Route::patch('address/{address}', 'updateAddress')->name('profile.address.update');
    Route::delete('address/{address}', 'destroyAddress')->name('profile.address.destroy');
    Route::get('orders', 'orders')->name('profile.orders');
    Route::get('wishlist', 'wishlist')->name('profile.wishlist');
    Route::get('wallet', 'wallet')->name('profile.wallet');
    Route::get('messages', 'messages')->name('profile.messages');
    Route::get('reviews', 'reviews')->name('profile.reviews');
});

require __DIR__ . '/auth.php';
