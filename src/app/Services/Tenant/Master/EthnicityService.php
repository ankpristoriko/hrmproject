<?php

namespace App\Services\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Master\Ethnicity;
use App\Services\Tenant\TenantService;

class EthnicityService extends TenantService
{
    public function __construct(Ethnicity $ethnicity)
    {
        $this->model = $ethnicity;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'name' => 'required|min:2',
        ])->validate();

        return $this;
    }

    public function validateEthnicities(): EthnicityService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasEthnicity(),
            new GeneralException(__t('you_cant_update_ethnicity_if_the_type_already_has_ethnicity_applied'))
        );

        return $this;
    }
}
