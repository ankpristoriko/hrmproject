<?php

namespace App\Http\Controllers\Tenant\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Employee\EmployeeLicenseRequest;
use App\Models\Core\Auth\User;
use App\Models\Tenant\Employee\UserLicense;
use App\Services\Tenant\Employee\EmployeeLicenseService;

class EmployeeLicenseController extends Controller
{
    public function __construct(EmployeeLicenseService $service)
    {
        $this->service = $service;
    }

    public function index(User $employee)
    {
        return $employee->licenses->sortBy(function (UserLicense $license) {
            return $license->id;
        });
    }

    public function store(User $employee, EmployeeLicenseRequest $request)
    {
        $employee->licenses()->save(new UserLicense([
            'key' => 'employee_licenses',
            'value' => json_encode($request->only('license_name', 'license_description', 'valid_from', 'valid_to', 'license_no'))
        ]));

        return created_responses('employee_licenses');
    }

    public function show(User $employee, UserLicense $license)
    {
        return $license;
    }
    
    public function update(User $employee,UserLicense $license, EmployeeLicenseRequest $request)
    {
        $license->update([
            'value' => $request->only('license_name', 'license_description', 'valid_from', 'valid_to', 'license_no')
        ]);

        return updated_responses('employee_licenses');
    }

    public function destroy(User $employee, UserLicense $license)
    {
        $license->delete();

        return deleted_responses('employee_licenses');
    }
}
