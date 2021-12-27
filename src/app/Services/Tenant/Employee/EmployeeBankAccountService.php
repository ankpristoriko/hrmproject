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
            'bank_id' => 'required',
            'branch_name' => 'required',
            'account_holder_name' => 'required',
            'bank_account_no' => 'required',
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
            'value' => json_encode($this->getAttributes('bank_id', 'branch_name', 'account_holder_name', 'bank_account_no'))
        ]);

        return $this;
    }
}
