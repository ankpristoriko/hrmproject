<?php

namespace App\Services\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Master\Religion;
use App\Services\Tenant\TenantService;

class ReligionService extends TenantService
{
    public function __construct(Religion $religion)
    {
        $this->model = $religion;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'name' => 'required|min:2',
        ])->validate();

        return $this;
    }

    public function validateReligions(): ReligionService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasReligion(),
            new GeneralException(__t('you_cant_update_religion_if_the_type_already_has_religion_applied'))
        );

        return $this;
    }
}
