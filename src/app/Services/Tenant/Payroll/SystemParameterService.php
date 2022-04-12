<?php

namespace App\Services\Tenant\Payroll;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Payroll\SystemParameter;
use App\Services\Tenant\TenantService;

class SystemParameterService extends TenantService
{
    public function __construct(SystemParameter $systemParameter)
    {
        $this->model = $systemParameter;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'parameter_code' => 'required|min:2',
            'parameter_value' => 'required',
        ])->validate();

        return $this;
    }

    public function validateSystemParameters(): SystemParameterService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasSystemParameter(),
            new GeneralException(__t('you_cant_update_system_parameter_if_the_type_already_has_system_parameter_applied'))
        );

        return $this;
    }
}
