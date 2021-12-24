<?php

namespace App\Services\Tenant\Employee;

use App\Models\Core\Auth\User;
use App\Services\Tenant\TenantService;

class EmployeeLicenseService extends TenantService
{
    public function __construct(User $employee)
    {
        $this->model = $employee;
    }

    public function validateLicense()
    {
        validator($this->getAttributes(), [
            'license_name' => 'required',
            'valid_from' => 'required',
            'valid_to' => 'required',
            'license_no' => 'required',
        ])->validate();

        return $this;
    }

    public function updateLicense()
    {
        $this->model->licenses()->updateOrCreate([
            'user_id' => $this->model->id,
            'key' => $this->getAttribute('type')
        ], [
            'user_id' => $this->model->id,
            'key' => $this->getAttribute('type'),
            'value' => json_encode($this->getAttributes('license_name', 'license_description', 'valid_from', 'valid_to', 'license_no'))
        ]);

        return $this;
    }
}
