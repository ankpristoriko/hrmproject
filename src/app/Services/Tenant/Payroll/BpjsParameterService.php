<?php

namespace App\Services\Tenant\Payroll;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Payroll\BpjsParameter;
use App\Services\Tenant\TenantService;

class BpjsParameterService extends TenantService
{
    public function __construct(BpjsParameter $bpjsParameter)
    {
        $this->model = $bpjsParameter;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'parameter_code' => 'required|min:2',
            'parameter_value' => 'required',
        ])->validate();

        return $this;
    }

    public function validateBpjsParameters(): BpjsParameterService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasBpjsParameter(),
            new GeneralException(__t('you_cant_update_bpjs_parameter_if_the_type_already_has_bpjs_parameter_applied'))
        );

        return $this;
    }
}
