<?php

namespace App\Services\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Master\TerminationType;
use App\Services\Tenant\TenantService;

class TerminationTypeService extends TenantService
{
    public function __construct(TerminationType $terminationType)
    {
        $this->model = $terminationType;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'name' => 'required|min:2',
        ])->validate();

        return $this;
    }

    public function validateTerminations(): TerminationTypeService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasTermination(),
            new GeneralException(__t('you_cant_update_termination_type_if_the_type_already_has_termination_applied'))
        );

        return $this;
    }
}
