<?php

// use Illuminate\Http\Request;

// /*
// |--------------------------------------------------------------------------
// | API Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register API routes for your application. These
// | routes are loaded by the RouteServiceProvider within a group which
// | is assigned the "api" middleware group. Enjoy building your API!
// |
// */

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware'=>'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::apiResource('/employee', 'Api\EmployeeController');
Route::apiResource('/supplier', 'Api\SupplierController');
Route::apiResource('/category', 'Api\CategoryController');
Route::apiResource('/product', 'Api\ProductController');
Route::apiResource('/expense', 'Api\ExpenseController');
Route::apiResource('/customer', 'Api\CustomerController');

Route::post('/salary/paid/{id}', 'Api\SalaryController@Paid');
Route::get('/salary', 'Api\SalaryController@AllSalary');
Route::get('/salary/view/{id}', 'Api\SalaryController@ViewSalary');
Route::get('/edit/salary/{id}', 'Api\SalaryController@EditSalary');
Route::post('/salary/update/{id}', 'Api\SalaryController@SalaryUpdate');
Route::post('/stock/update/{id}', 'Api\SalaryController@StockUpdate');

Route::get('/getting/product/{id}', 'Api\PosController@GetProduct');
Route::get('/addToCart/{id}', 'Api\CartController@addToCart');
Route::get('/addToCart/{id}', 'Api\CartController@addToCart');
Route::get('/cart/product', 'Api\CartController@CartProduct');
Route::get('/remove/cart/{id}', 'Api\CartController@removeCart');
Route::get('/increment/{id}', 'Api\CartController@Increment');
Route::get('/decrement/{id}', 'Api\CartController@Decrement');
Route::get('/vats', 'Api\CartController@Vats');
Route::post('/orderdone', 'Api\PosController@OrderDone');
Route::get('/orders', 'Api\OrderController@TodayOrder');
Route::get('/order/details/{id}', 'Api\OrderController@OrderDetails');
Route::get('/order/orderdetails/{id}', 'Api\OrderController@OrderDetailsAll');
Route::post('/search/order/', 'Api\OrderController@SearchOrderDate');
Route::post('/search/month/', 'Api\OrderController@SearchMonth');
// Home Component
Route::get('/today/sell', 'Api\PosController@TodaySell');
Route::get('/today/income', 'Api\PosController@TodayIncome');
Route::get('/today/due', 'Api\PosController@TodayDue');
Route::get('/today/expense', 'Api\PosController@TodayExpense');
Route::get('/stockout', 'Api\PosController@StockOut');
