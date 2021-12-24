<?php

namespace App\Services\Tenant\Employee;

use App\Models\Core\Auth\User;
use App\Services\Tenant\TenantService;

class EmployeeWorkExperienceService extends TenantService
{
    public function __construct(User $employee)
    {
        $this->model = $employee;
    }

    public function validateWorkExperience()
    {
        validator($this->getAttributes(), [
            'company_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'job_title' => 'required',
        ])->validate();

        return $this;
    }

    public function updateWorkExperience()
    {
        $this->model->workExperiences()->updateOrCreate([
            'user_id' => $this->model->id,
            'key' => $this->getAttribute('type')
        ], [
            'user_id' => $this->model->id,
            'key' => $this->getAttribute('type'),
            'value' => json_encode($this->getAttributes('company_name', 'job_title', 'location', 'start_date', 'end_date', 'job_description', 'last_salary', 'reason_of_leaving', 'company_description'))
        ]);

        return $this;
    }
}
