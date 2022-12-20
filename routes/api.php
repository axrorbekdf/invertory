<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\SupplierController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\PosController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\ExpenseController;
use App\Http\Controllers\API\SalaryController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\OrderController;

Route::group(['middleware' => 'api', 'prefix' => 'auth' ], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::apiResource('/employees', EmployeeController::class);

Route::apiResource('/suppliers', SupplierController::class);

Route::apiResource('/categories', CategoryController::class);

Route::apiResource('/products', ProductController::class);

Route::apiResource('/expenses', ExpenseController::class);

Route::apiResource('/customers', CustomerController::class);


Route::get('/salary', [SalaryController::class, 'allSalary']);
Route::post('/salary/paid/{id}', [SalaryController::class, 'paid']);
Route::post('/salary/view/{month}', [SalaryController::class, 'view']);

Route::get('/salary/edit/{id}', [SalaryController::class, 'edit']);
Route::post('/salary/update/{id}', [SalaryController::class, 'updateSalary']);

Route::post('/stock/update/{id}', [ProductController::class, 'updateStock']);
Route::get('/getting/product/{id}', [PosController::class, 'getProduct']);

// CART routes
Route::get('/addToCart/{id}', [CartController::class, 'AddToCart']);
Route::get('/cart/products', [CartController::class, 'CartProduct']);
Route::get('/remove/cart/{id}', [CartController::class, 'RemoveCart']);
Route::get('/increment/cart/{id}', [CartController::class, 'IncrementCart']);
Route::get('/decrement/cart/{id}', [CartController::class, 'DecrementCart']);

// VAT routes
Route::get('/vats', [CartController::class, 'Vats']);

Route::post('/orderdone', [PosController::class, 'OrderDone']);


Route::post('/orders', [OrderController::class, 'TodayOrder']);