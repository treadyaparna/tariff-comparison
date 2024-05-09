<?php

use App\Http\Controllers\TariffComparisonController;
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
    // comparison routes
    $api->post('compare-tariffs', [TariffComparisonController::class, 'tariffComparison']);
});


