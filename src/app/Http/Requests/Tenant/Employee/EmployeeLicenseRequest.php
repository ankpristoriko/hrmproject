<?php

namespace App\Http\Requests\Tenant\Employee;

use App\Http\Requests\BaseRequest;

class EmployeeLicenseRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'license_name' => 'required',
            'valid_from' => 'required',
            'valid_to' => 'required',
            'license_no' => 'required',
        ];
    }
}
