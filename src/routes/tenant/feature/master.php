<?php

use App\Http\Controllers\Tenant\Master\DocumentTypeController;
use App\Http\Controllers\Tenant\Master\WarningTypeController;
use App\Http\Controllers\Tenant\Master\AwardTypeController;
use App\Http\Controllers\Tenant\Master\TerminationTypeController;
use App\Http\Controllers\Tenant\Master\ExpenseTypeController;
use App\Http\Controllers\Tenant\Master\TrainingTypeController;
use App\Http\Controllers\Tenant\Master\EducationLevelController;
use Illuminate\Routing\Router;

Route::group(['prefix' => 'app'], function (Router $router) {
    $router->apiResource('document-types', DocumentTypeController::class);
    $router->apiResource('warning-types', WarningTypeController::class);
    $router->apiResource('award-types', AwardTypeController::class);
    $router->apiResource('termination-types', TerminationTypeController::class);
    $router->apiResource('expense-types', ExpenseTypeController::class);
    $router->apiResource('training-types', TrainingTypeController::class);
    $router->apiResource('education-levels', EducationLevelController::class);

});