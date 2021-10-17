<?php

namespace App\Http\Requests\Tenant\Recruitment;

use App\Http\Requests\BaseRequest;

class ApplicationFormRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'application_form' => 'required|array',
        ];
    }
}
