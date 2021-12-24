<?php

namespace App\Http\Requests\Tenant\Employee;

use App\Http\Requests\BaseRequest;

class EmployeeWorkExperienceRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'job_title' => 'required',
        ];
    }
}
