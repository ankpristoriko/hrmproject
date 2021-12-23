<?php

namespace App\Http\Controllers\Tenant\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Employee\EmployeeEducationRequest;
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

    public function store(User $employee, EmployeeEducationRequest $request)
    {
        $employee->educations()->save(new UserEducation([
            'key' => 'employee_educations',
            'value' => json_encode($request->only('education_level', 'education_field', 'educational_institution', 'educational_institution_detail', 'location', 'start_year', 'end_year', 'grade_point_average', 'achievement', 'remark'))
        ]));

        return created_responses('employee_educations');
    }

    public function show(User $employee, UserEducation $education)
    {
        return $education;
    }
    
    public function update(User $employee,UserEducation $education, EmployeeEducationRequest $request)
    {
        $education->update([
            'value' => $request->only('education_level', 'education_field', 'educational_institution', 'educational_institution_detail', 'location', 'start_year', 'end_year', 'grade_point_average', 'achievement', 'remark')
        ]);

        return updated_responses('employee_educations');
    }

    public function destroy(User $employee, UserEducation $education)
    {
        $education->delete();

        return deleted_responses('employee_educations');
    }
}
