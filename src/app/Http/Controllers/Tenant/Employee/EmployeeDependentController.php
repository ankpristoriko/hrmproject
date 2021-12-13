<?php

namespace App\Http\Controllers\Tenant\Employee;

use App\Http\Controllers\Controller;
use App\Models\Core\Auth\User;
use App\Services\Tenant\Employee\EmployeeDependentService;
use App\Models\Tenant\Employee\UserDependent;
use Illuminate\Http\Request;

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

    public function update(User $employee, Request $request)
    {
        $this->service
            ->setAttributes($request->only('name', 'identity_no', 'bpjs_no', 'place_of_birth', 'date_of_birth', 'gender', 'relationship_id', 'occupation', 'education_level', 'address', 'zip_code', 'city', 'country', 'state', 'nationality'))
            ->validateDependent()
            ->setModel($employee)
            ->updateDependent();

        return updated_responses('dependent');
    }

    public function delete(User $employee, $type)
    {
        $employee->dependents()->where('key', $type)->delete();

        return deleted_responses('dependent');
    }
}
