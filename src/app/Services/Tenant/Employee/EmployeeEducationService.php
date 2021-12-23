<?php

namespace App\Services\Tenant\Employee;

use App\Models\Core\Auth\User;
use App\Services\Tenant\TenantService;

class EmployeeEducationService extends TenantService
{
    public function __construct(User $employee)
    {
        $this->model = $employee;
    }

    public function validateEducation()
    {
        validator($this->getAttributes(), [
            'education_level' => 'required',
            'educational_institution' => 'required',
        ])->validate();

        return $this;
    }

    public function updateEducation()
    {
        $this->model->educations()->updateOrCreate([
            'user_id' => $this->model->id,
            'key' => $this->getAttribute('type')
        ], [
            'user_id' => $this->model->id,
            'key' => $this->getAttribute('type'),
            'value' => json_encode($this->getAttributes('education_level', 'education_field', 'educational_institution', 'educational_institution_detail', 'location', 'start_year', 'end_year', 'grade_point_average', 'achievement', 'remark'))
        ]);

        return $this;
    }
}
