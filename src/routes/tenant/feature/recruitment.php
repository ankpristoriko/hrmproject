<?php

use App\Http\Controllers\Tenant\Recruitment\JobTypeController;
use App\Http\Controllers\Tenant\Recruitment\EventTypeController;
use App\Http\Controllers\Tenant\Recruitment\StageController;
use Illuminate\Routing\Router;

Route::group(['prefix' => 'app'], function (Router $router) {
    $router->apiResource('job-types', JobTypeController::class);
    $router->apiResource('event-types', EventTypeController::class);
    $router->apiResource('stages', StageController::class);

});