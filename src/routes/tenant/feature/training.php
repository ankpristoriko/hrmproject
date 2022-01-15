<?php

use App\Http\Controllers\Tenant\Training\TrainingInstitutionController;
use Illuminate\Routing\Router;

Route::group(['prefix' => 'app'], function (Router $router) {
    $router->apiResource('training-institutions', TrainingInstitutionController::class);
});