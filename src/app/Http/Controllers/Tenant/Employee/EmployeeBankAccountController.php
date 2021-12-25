<?php

namespace App\Http\Controllers\Tenant\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Employee\EmployeeBankAccountRequest;
use App\Models\Core\Auth\User;
use App\Models\Tenant\Employee\UserBankAccount;
use App\Services\Tenant\Employee\EmployeeBankAccountService;

class EmployeeBankAccountController extends Controller
{
    public function __construct(EmployeeBankAccountService $service)
    {
        $this->service = $service;
    }

    public function index(User $employee)
    {
        return $employee->bankAccounts->sortBy(function (UserBankAccount $bankAccount) {
            return $bankAccount->id;
        });
    }

    public function store(User $employee, EmployeeBankAccountRequest $request)
    {
        $employee->bankAccounts()->save(new UserBankAccount([
            'key' => 'employee_bank_accounts',
            'value' => json_encode($request->only('account_title', 'account_number', 'bank_name', 'bank_code', 'bank_branch'))
        ]));

        return created_responses('employee_bank_accounts');
    }

    public function show(User $employee, UserBankAccount $bankAccount)
    {
        return $bankAccount;
    }
    
    public function update(User $employee,UserBankAccount $bankAccount, EmployeeBankAccountRequest $request)
    {
        $bankAccount->update([
            'value' => $request->only('account_title', 'account_number', 'bank_name', 'bank_code', 'bank_branch')
        ]);

        return updated_responses('employee_bank_accounts');
    }

    public function destroy(User $employee, UserBankAccount $bankAccount)
    {
        $bankAccount->delete();

        return deleted_responses('employee_bank_accounts');
    }
}