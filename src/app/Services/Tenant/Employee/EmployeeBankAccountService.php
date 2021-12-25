<?php

namespace App\Services\Tenant\Employee;

use App\Models\Core\Auth\User;
use App\Services\Tenant\TenantService;

class EmployeeBankAccountService extends TenantService
{
    public function __construct(User $employee)
    {
        $this->model = $employee;
    }

    public function validateBankAccount()
    {
        validator($this->getAttributes(), [
            'account_title' => 'required',
            'account_number' => 'required',
            'bank_code' => 'required',
        ])->validate();

        return $this;
    }

    public function updateBankAccount()
    {
        $this->model->bankAccounts()->updateOrCreate([
            'user_id' => $this->model->id,
            'key' => $this->getAttribute('type')
        ], [
            'user_id' => $this->model->id,
            'key' => $this->getAttribute('type'),
            'value' => json_encode($this->getAttributes('account_title', 'account_number', 'bank_name', 'bank_code', 'bank_branch'))
        ]);

        return $this;
    }
}
