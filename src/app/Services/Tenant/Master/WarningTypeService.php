<?php

namespace App\Services\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Master\WarningType;
use App\Services\Tenant\TenantService;

class WarningTypeService extends TenantService
{
    public function __construct(WarningType $warningType)
    {
        $this->model = $warningType;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'name' => 'required|min:2',
        ])->validate();

        return $this;
    }

    public function validateWarnings(): WarningTypeService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasWarning(),
            new GeneralException(__t('you_cant_update_warning_type_if_the_type_already_has_warning_applied'))
        );

        return $this;
    }
}
