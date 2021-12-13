<?php

namespace App\Services\Tenant\Employee;

use App\Models\Core\Auth\User;
use App\Services\Tenant\TenantService;

class EmployeeDependentService extends TenantService
{
    public function __construct(User $employee)
    {
        $this->model = $employee;
    }

    public function validateDependent()
    {
        validator($this->getAttributes(), [
            'name' => 'required',
            'relationship_id' => 'required',
            'date_of_birth' => 'required',
        ])->validate();

        return $this;
    }

    public function updateDependent()
    {
        $this->model->dependents()->updateOrCreate([
            'user_id' => $this->model->id,
            'key' => $this->getAttribute('type')
        ], [
            'user_id' => $this->model->id,
            'key' => $this->getAttribute('type'),
            'value' => json_encode($this->getAttributes('name', 'identity_no', 'bpjs_no', 'place_of_birth', 'date_of_birth', 'gender', 'relationship_id', 'occupation', 'education_level', 'address', 'zip_code', 'city', 'country', 'state', 'nationality'))
        ]);

        return $this;
    }
}
