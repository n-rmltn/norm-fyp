<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SpecController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CompatibilityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/', [ProductController::class, 'dashboard'])->name('dashboard');
    // Orders
    Route::get('/orders', [OrderController::class, 'order'])->name('orders');
    Route::get('/orders/{id}/create', [OrderController::class, 'createOrderForm'])->name('orders.create');
    Route::post('/orders/{id}/create', [OrderController::class, 'create'])->name('orders.store');
    Route::post('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('ajax/orders-search', [OrderController::class, 'searchOrder'])->name('orders.search');
    // Users
    Route::get('/users', [ProfileController::class, 'users'])->name('profile.users');
    Route::get('ajax/users-search', [ProfileController::class, 'searchUser'])->name('users.search');
    Route::get('/profile/{id}/edit', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/destroy/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Product All
    Route::get('/product', [ProductController::class, 'product'])->name('product');
    Route::get('ajax/product-search/', [ProductController::class, 'searchProduct'])->name('product.search');
    Route::get('/ajax-notifications', [ProductController::class, 'checkLowStock'])->name('ajax.notifications');
    Route::post('/ajax-dismiss-notifications', [ProductController::class, 'dismissNotifications'])->name('ajax.dismiss');
    // Comparison AJAX
    Route::get('/comparison', [ProductController::class, 'index'])->name('comparison.index');
    Route::post('/comparison/{id}', [ProductController::class, 'store'])->name('comparison.store');
    Route::delete('/comparison/{id}', [ProductController::class, 'destroy']);
    Route::post('/check-compatibility', [ProductController::class, 'checkCompatibility']);

    // Admin middleware
    Route::middleware([AdminMiddleware::class])->group(function () {

        // Orders
        Route::post('/orders/{id}/accept', [OrderController::class, 'accept'])->name('orders.accept');
        Route::post('/orders/{id}/reject', [OrderController::class, 'reject'])->name('orders.reject');
        // Product
        Route::put('admin/{id}', [ProfileController::class, 'updateAdmin'])->name('profile.updateAdmin');
        Route::get('/product/{id}/edit', [ProductController::class, 'show'])->name('product.show');
        Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::put('/product/{id}/thumb', [ProductController::class, 'updateThumb'])->name('product.updateThumb');
        Route::get('/product/create', [ProductController::class, 'createProductForm'])->name('product.create');
        Route::post('/product/create', [ProductController::class, 'create']);

        // Brands
        Route::get('/brands', [BrandController::class, 'product_brand'])->name('product.brands');
        Route::get('ajax/brands-search', [BrandController::class, 'searchBrand'])->name('brands.search');
        Route::get('/brands/{id}/edit', [BrandController::class, 'show'])->name('brands.show');
        Route::put('/brands/{id}', [BrandController::class, 'update'])->name('brands.update');
        Route::get('/brands/create', [BrandController::class, 'createBrandForm'])->name('brands.create');
        Route::post('/brands/create', [BrandController::class, 'create']);
        Route::delete('/brands/destroy/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');

        // Category
        Route::get('/category', [CategoryController::class, 'product_category'])->name('product.category');
        Route::get('ajax/category-search', [CategoryController::class, 'searchCategory'])->name('category.search');
        Route::get('/category/{id}/edit', [CategoryController::class, 'show'])->name('category.show');
        Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/category/create', [CategoryController::class, 'createCategoryForm'])->name('category.create');
        Route::post('/category/create', [CategoryController::class, 'create']);
        Route::delete('/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

        // Specs
        Route::get('/spec', [SpecController::class, 'product_spec'])->name('product.spec');
        Route::get('ajax/spec-search', [SpecController::class, 'searchSpec'])->name('spec.search');
        Route::get('/spec/{id}/edit', [SpecController::class, 'show'])->name('spec.show');
        Route::put('/spec/{id}', [SpecController::class, 'update'])->name('spec.update');
        Route::get('/spec/create', [SpecController::class, 'createSpecForm'])->name('spec.create');
        Route::post('/spec/create', [SpecController::class, 'create']);
        Route::delete('/spec/destroy/{id}', [SpecController::class, 'destroy'])->name('spec.destroy');

        // Compatibility
        Route::get('/compatibility', [CompatibilityController::class, 'product_compatibility'])->name('product.compatibility');
        Route::get('ajax/compatibility-search', [CompatibilityController::class, 'searchCompatibility'])->name('compatibility.search');
        Route::get('/compatibility/{id}/edit', [CompatibilityController::class, 'show'])->name('compatibility.show');
        Route::put('/compatibility/{id}', [CompatibilityController::class, 'update'])->name('compatibility.update');
        Route::get('/compatibility/create', [CompatibilityController::class, 'createCompatibilityForm'])->name('compatibility.create');
        Route::post('/compatibility/create', [CompatibilityController::class, 'create']);
        Route::delete('/compatibility/destroy/{id}', [CompatibilityController::class, 'destroy'])->name('compatibility.destroy');
    });

});

require __DIR__ . '/auth.php';
