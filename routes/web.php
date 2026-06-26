<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Customer;
use App\Livewire\Admin\Provider;
use App\Livewire\Admin\Product;
use App\Livewire\Admin\Sale;
use App\Livewire\Admin\SaleDetail;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

	Route::view('dashboard', 'dashboard')->name('dashboard');

	Route::get('/admin/customer', Customer\Index::class)->name('admin.customer.index');
	Route::get('/admin/provider', Provider\Index::class)->name('admin.provider.index');
	Route::get('/admin/product', Product\Index::class)->name('admin.product.index');
	Route::get('/admin/sale', Sale\Index::class)->name('admin.sale.index');
	Route::get('/admin/sale-detail', SaleDetail\Index::class)->name('admin.sale-detail.index');
});

require __DIR__ . '/settings.php';
