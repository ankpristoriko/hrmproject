<?php

namespace App\Http\Controllers\Tenant\Employee;

use App\Http\Controllers\Controller;
use App\Models\Core\Auth\User;
use App\Services\Tenant\Employee\EmployeeDocumentService;
use Illuminate\Http\Request;

class EmployeeDocumentController extends Controller
{
    public function __construct(EmployeeDocumentService $service)
    {
        $this->service = $service;
    }

    public function show(User $employee)
    {
        return $employee->documents;
    }

    public function update(User $employee, Request $request)
    {
        $this->service
            ->setAttributes($request->only('document_no', 'type', 'valid_from', 'valid_to', 'note'))
            ->validateDocument()
            ->setModel($employee)
            ->updateDocument();

        return updated_responses('document');
    }

    public function delete(User $employee, $type)
    {
        $employee->documents()->where('key', $type)->delete();

        return deleted_responses('document');
    }
}
