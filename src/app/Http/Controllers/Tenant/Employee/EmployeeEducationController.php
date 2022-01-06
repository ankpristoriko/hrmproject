<?php

namespace App\Http\Controllers\Tenant\Employee;

use App\Http\Controllers\Controller;
use App\Models\Core\Auth\User;
use App\Models\Tenant\Employee\UserEducation;
use App\Services\Tenant\Employee\EmployeeEducationService;

class EmployeeEducationController extends Controller
{
    public function __construct(EmployeeEducationService $service)
    {
        $this->service = $service;
    }

    public function index(User $employee)
    {
        return $employee->educations->sortBy(function (UserEducation $education) {
            return $education->id;
        });
    }

    public function store() {
        $this->service
            ->setAttributes(request()->all())
            ->basicValidations()
            ->saveEmployeeEducation();

        return updated_responses('employee_educations');
    }

    public function show(User $employee, UserEducation $education)
    {
        return $education;
    }

    public function destroy(User $employee, UserEducation $education)
    {
        $education->delete();

        return deleted_responses('employee_educations');
    }
}
