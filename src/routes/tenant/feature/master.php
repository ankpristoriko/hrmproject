<?php

use App\Http\Controllers\Tenant\Master\DocumentTypeController;
use App\Http\Controllers\Tenant\Master\WarningTypeController;
use App\Http\Controllers\Tenant\Master\AwardTypeController;
use App\Http\Controllers\Tenant\Master\TerminationTypeController;
use App\Http\Controllers\Tenant\Master\ExpenseTypeController;
use App\Http\Controllers\Tenant\Master\TrainingTypeController;
use App\Http\Controllers\Tenant\Master\EducationLevelController;
use App\Http\Controllers\Tenant\Master\EducationalInstitutionController;
use App\Http\Controllers\Tenant\Master\RelationshipController;
use App\Http\Controllers\Tenant\Master\ReligionController;
use App\Http\Controllers\Tenant\Master\EthnicityController;
use App\Http\Controllers\Tenant\Master\BankController;
use App\Http\Controllers\Tenant\Master\LicenseController;
use App\Http\Controllers\Tenant\Master\IndustryAreaController;
use App\Http\Controllers\Tenant\Master\CourseCategoryController;
use App\Http\Controllers\Tenant\Master\CourseMaterialCategoryController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'app', 'as' => 'app_permission.', 'middleware' => ['permission']], function (Router $router) {
    $router->apiResource('document-types', DocumentTypeController::class);
    $router->apiResource('warning-types', WarningTypeController::class);
    $router->apiResource('award-types', AwardTypeController::class);
    $router->apiResource('termination-types', TerminationTypeController::class);
    $router->apiResource('expense-types', ExpenseTypeController::class);
    $router->apiResource('training-types', TrainingTypeController::class);
    $router->apiResource('education-levels', EducationLevelController::class);
    $router->apiResource('educational-institutions', EducationalInstitutionController::class);
    $router->apiResource('relationships', RelationshipController::class);
    $router->apiResource('religions', ReligionController::class);
    $router->apiResource('ethnicities', EthnicityController::class);
    $router->apiResource('banks', BankController::class);
    $router->apiResource('licenses', LicenseController::class);
    $router->apiResource('industry-areas', IndustryAreaController::class);
    $router->apiResource('course-categories', CourseCategoryController::class);
    $router->apiResource('course-material-categories', CourseMaterialCategoryController::class);

    $router->get('educational-institutions/{id}', [EducationalInstitutionController::class, 'getInstitutionLocation'])
        ->name('educational-institutions.index');

});