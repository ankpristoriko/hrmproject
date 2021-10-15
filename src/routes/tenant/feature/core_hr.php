<?php

use App\Http\Controllers\Tenant\CoreHR\PromotionController;
use Illuminate\Routing\Router;

Route::group(['prefix' => 'app'], function (Router $router) {
    $router->get('core_hr/promotion', [PromotionController::class, 'view'])
        ->name('promotion.data');
    $router->get('core_hr/promotion/employee', [PromotionController::class, 'getEmployeeFromPromotion']);
    $router->resource('core_hr/promotions', PromotionController::class);
});