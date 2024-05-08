<?php

use App\Http\Controllers\ComparisonController;
use Dingo\Api\Routing\Router;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* @var Router $api */
$api = app(Router::class);
$api->version('v1', function ($api) {

    // admin authentication routes
    $api->post('login', [AuthController::class, 'login']);
    $api->post('register', [AuthController::class, 'register']);
    $api->post('logout', ['middleware' => 'api.auth', AuthController::class, 'logout']);

    // comparison routes
    $api->post('tariff-comparison', [ComparisonController::class, 'compareTariff']);
    //$api->get('tariffs', [ComparisonController::class, 'getTariffs']);
});


