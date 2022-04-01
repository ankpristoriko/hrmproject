<?php

namespace App\Http\Controllers\Tenant\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Employee\EmployeeWorkExperienceRequest;
use App\Models\Core\Auth\User;
use App\Models\Tenant\Employee\UserWorkExperience;
use App\Services\Tenant\Employee\EmployeeWorkExperienceService;

class SystemParameterController extends Controller
{
    public function __construct(EmployeeWorkExperienceService $service)
    {
        $this->service = $service;
    }

    public function index(User $employee)
    {
        return $employee->workExperiences->sortBy(function (UserWorkExperience $workExperience) {
            return $workExperience->id;
        });
    }

    public function store(User $employee, EmployeeWorkExperienceRequest $request)
    {
        $employee->workExperiences()->save(new UserWorkExperience([
            'key' => 'employee_work_experiences',
            'value' => json_encode($request->only('company_name', 'job_title', 'location', 'start_date', 'end_date', 'job_description', 'last_salary', 'reason_of_leaving', 'company_description'))
        ]));

        return created_responses('employee_work_experiences');
    }

    public function show(User $employee, UserWorkExperience $workExperience)
    {
        return $workExperience;
    }
    
    public function update(User $employee,UserWorkExperience $workExperience, EmployeeWorkExperienceRequest $request)
    {
        $workExperience->update([
            'value' => $request->only('company_name', 'job_title', 'location', 'start_date', 'end_date', 'job_description', 'last_salary', 'reason_of_leaving', 'company_description')
        ]);

        return updated_responses('employee_work_experiences');
    }

    public function destroy(User $employee, UserWorkExperience $workExperience)
    {
        $workExperience->delete();

        return deleted_responses('employee_work_experiences');
    }
}
