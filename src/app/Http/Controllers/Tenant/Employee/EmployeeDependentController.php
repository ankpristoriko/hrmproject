<?php

namespace App\Http\Controllers\Tenant\Employee;

use App\Http\Controllers\Controller;
use App\Models\Core\Auth\User;
use App\Services\Tenant\Employee\EmployeeDependentService;
use App\Models\Tenant\Employee\UserDependent;
use App\Http\Requests\Tenant\Employee\EmployeeDependentRequest;

class EmployeeDependentController extends Controller
{
    public function __construct(EmployeeDependentService $service)
    {
        $this->service = $service;
    }

    public function index(User $employee)
    {
        return $employee->dependents->sortBy(function (UserDependent $dependent) {
            return $dependent->id;
        });
    }

    public function store(User $employee, EmployeeDependentRequest $request)
    {
        $employee->dependents()->save(new UserDependent([
            'key' => 'employee_dependents',
            'value' => json_encode($request->only('name', 'identity_no', 'bpjs_no', 'place_of_birth', 'date_of_birth', 'gender', 'relationship_id', 'occupation', 'education_level', 'address', 'zip_code', 'city', 'country', 'state', 'nationality'))
        ]));

        return created_responses('employee_dependents');
    }

    public function show(User $employee, UserDependent $employee_dependent)
    {
        return $employee_dependent;
    }
    
    public function update(User $employee,UserDependent $employee_dependent, EmployeeDependentRequest $request)
    {
        $employee_dependent->update([
            'value' => $request->only('name', 'identity_no', 'bpjs_no', 'place_of_birth', 'date_of_birth', 'gender', 'relationship_id', 'occupation', 'education_level', 'address', 'zip_code', 'city', 'country', 'state', 'nationality')
        ]);

        return updated_responses('employee_dependents');
    }

    public function destroy(User $employee, UserDependent $employee_dependent)
    {
        $employee_dependent->delete();

        return deleted_responses('employee_dependents');
    }
}
