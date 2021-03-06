<?php

use App\Http\Controllers\Tenant\Employee\DepartmentController;
use App\Http\Controllers\Tenant\Employee\DepartmentEmployeeController;
use App\Http\Controllers\Tenant\Employee\DepartmentStatusController;
use App\Http\Controllers\Tenant\Employee\EmployeeAddressController;
use App\Http\Controllers\Tenant\Employee\EmployeeDocumentController;
use App\Http\Controllers\Tenant\Employee\EmployeeDependentController;
use App\Http\Controllers\Tenant\Employee\EmployeeEducationController;
use App\Http\Controllers\Tenant\Employee\EmployeeLicenseController;
use App\Http\Controllers\Tenant\Employee\EmployeeWorkExperienceController;
use App\Http\Controllers\Tenant\Employee\EmployeeBankAccountController;
use App\Http\Controllers\Tenant\Employee\EmployeeContactController;
use App\Http\Controllers\Tenant\Employee\EmployeeController;
use App\Http\Controllers\Tenant\Employee\EmployeeInviteController;
use App\Http\Controllers\Tenant\Employee\EmployeeJobHistoryController;
use App\Http\Controllers\Tenant\Employee\EmployeePayrunController;
use App\Http\Controllers\Tenant\Employee\EmployeeSalaryController;
use App\Http\Controllers\Tenant\Employee\EmployeeSocialLinkController;
use App\Http\Controllers\Tenant\Employee\EmployeeUpdateController;
use App\Http\Controllers\Tenant\Employee\EmploymentStatusController;
use App\Http\Controllers\Tenant\Employee\DesignationController;
use App\Http\Controllers\Tenant\Employee\OrganizationStructureController;
use App\Http\Controllers\Tenant\Holiday\HolidayController;
use App\Http\Controllers\Tenant\Employee\EmployeeEmploymentStatusController;
use App\Http\Controllers\Tenant\Employee\EmployeeProfileController;
use Illuminate\Routing\Router;

Route::group(['prefix' => 'app'], function (Router $router) {
    $router->post('departments/move-employees', [DepartmentEmployeeController::class, 'update'])
        ->name('department-employees.move');

    $router->get('departments/{department}/employees', [DepartmentEmployeeController::class, 'getEmployees'])
        ->name('department-user.index');

    $router->post('departments/{department}/update-status', [DepartmentStatusController::class, 'update'])
        ->name('department-status.update');

    $router->get('organization-structure', [OrganizationStructureController::class, 'index'])
        ->name('organization-chart.index');

    $router->apiResource('departments', DepartmentController::class)
        ->middleware(['can_access:view_departments', 'check_behavior']);

    $router->apiResource('employment-statuses', EmploymentStatusController::class);

    $router->apiResource('designations', DesignationController::class);

    $router->apiResource('holidays', HolidayController::class)
        ->middleware(['can_access:view_all_departments_holidays', 'check_behavior']);

    $router->group(['prefix' => 'employees/{employee}'], function (Router $router) {
        $router->patch('terminate', [EmployeeEmploymentStatusController::class, 'terminate'])
            ->name('employees.terminate')
            ->middleware('check_behavior');

        $router->patch('rejoin', [EmployeeEmploymentStatusController::class, 'rejoin'])
            ->name('employees.rejoin')
            ->middleware('check_behavior');

        $router->patch('update-status/{status}', [EmployeeEmploymentStatusController::class, 'update'])
            ->name('employees.update-status');

        $router->delete('cancel-invitation', [EmployeeInviteController::class, 'cancel'])
            ->name('invitation.cancel-employee');

        $router->patch('addresses', [EmployeeAddressController::class, 'update'])
            ->name('employee-address.update');

        $router->delete('addresses/{type}', [EmployeeAddressController::class, 'delete'])
            ->name('employee-address.delete');

        $router->patch('documents', [EmployeeDocumentController::class, 'update'])
            ->name('employee-documents.update');

        $router->delete('documents/{type}', [EmployeeDocumentController::class, 'delete'])
            ->name('employee-documents.delete');

        $router->delete('educations/{educationId}', [EmployeeEducationController::class, 'delete'])
            ->name('employee-educations.delete');

        $router->get('job-history', [EmployeeJobHistoryController::class, 'index'])
            ->name('job-history.index');

        $router->patch('{type}/update', [EmployeeUpdateController::class, 'update'])
            ->name('employee-job-history.update');

        $router->get('salaries', [EmployeeSalaryController::class, 'index'])
            ->name('salary.index');

        $router->get('payrun-setting/restore', [EmployeePayrunController::class, 'restore'])
            ->name('employee-payrun.restore');

        $router->post('payrun-setting/update-payrun', [EmployeePayrunController::class, 'updatePayrun'])
            ->name('employee-payrun.update');

        $router->post('payrun-setting/update-beneficiary', [EmployeePayrunController::class, 'updateBeneficiary'])
            ->name('employee-beneficiary.update');

        $router->apiResource('dependents', EmployeeDependentController::class, [
            'names' => [
                'store' => 'employee-dependents.store',
                'destroy' => 'employee-dependents.destroy',
                'update' => 'employee-dependents.update',
                'show' => 'employee-dependents.show'
            ]
        ])->except('index');

        $router->apiResource('educations', EmployeeEducationController::class, [
            'names' => [
                'store' => 'employee-educations.store',
                // 'destroy' => 'employee-educations.destroy',
                // 'update' => 'employee-educations.update',
                'show' => 'employee-educations.show'
            ]
        ])->except('index');

        $router->apiResource('licenses', EmployeeLicenseController::class, [
            'names' => [
                'store' => 'employee-licenses.store',
                'destroy' => 'employee-licenses.destroy',
                'update' => 'employee-licenses.update',
                'show' => 'employee-licenses.show'
            ]
        ])->except('index');

        $router->apiResource('work-experiences', EmployeeWorkExperienceController::class, [
            'names' => [
                'store' => 'employee-work-experiences.store',
                'destroy' => 'employee-work-experiences.destroy',
                'update' => 'employee-work-experiences.update',
                'show' => 'employee-work-experiences.show'
            ]
        ])->except('index');

        $router->apiResource('bank-accounts', EmployeeBankAccountController::class, [
            'names' => [
                'store' => 'employee-bank-accounts.store',
                'destroy' => 'employee-bank-accounts.destroy',
                'update' => 'employee-bank-accounts.update',
                'show' => 'employee-bank-accounts.show'
            ]
        ])->except('index');

        $router->apiResource('emergency-contacts', EmployeeContactController::class, [
            'names' => [
                'store' => 'employee-emergency-contacts.store',
                'destroy' => 'employee-emergency-contacts.destroy',
                'update' => 'employee-emergency-contacts.update',
                'show' => 'employee-emergency-contacts.show'
            ]
        ])->except('index');
    });

    $router->post('employees/education', [EmployeeEducationController::class, 'store'])
        ->name('employee-educations.store');

    $router->post('employees/invite', [EmployeeInviteController::class, 'invite'])
        ->name('employees.invite')
        ->middleware('check_behavior');

    $router->apiResource('employees', EmployeeController::class)
        ->except('store', 'show', 'index')
        ->middleware(['employee_access', 'can_access:view_employees', 'check_behavior']);

    $router->post('employees/{type}/update',[EmployeeProfileController::class,'updateEmployees'])
        ->name('employees.update');

});
