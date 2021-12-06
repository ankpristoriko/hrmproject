<?php

namespace App\Services\Tenant\Employee;

use App\Models\Core\Auth\User;
use App\Services\Tenant\TenantService;

class EmployeeDocumentService extends TenantService
{
    public function __construct(User $employee)
    {
        $this->model = $employee;
    }

    public function validateDocument()
    {
        validator($this->getAttributes(), [
            'document_no' => 'required',
            'valid_from' => 'required',
            'valid_to' => 'required',
            'type' => 'required|in:ktp,npwp'
        ])->validate();

        return $this;
    }

    public function updateDocument()
    {
        $this->model->documents()->updateOrCreate([
            'user_id' => $this->model->id,
            'key' => $this->getAttribute('type')
        ], [
            'user_id' => $this->model->id,
            'key' => $this->getAttribute('type'),
            'value' => json_encode($this->getAttributes('document_no', 'valid_from', 'valid_to', 'note'))
        ]);

        return $this;
    }
}
