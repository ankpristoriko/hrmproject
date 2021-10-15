<?php

namespace App\Services\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Master\EducationLevel;
use App\Services\Tenant\TenantService;

class EducationLevelService extends TenantService
{
    public function __construct(EducationLevel $educationLevel)
    {
        $this->model = $educationLevel;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'name' => 'required|min:2',
        ])->validate();

        return $this;
    }

    public function validateEducationLevels(): EducationLevelService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasEducation(),
            new GeneralException(__t('you_cant_update_education_level_if_the_type_already_has_education_applied'))
        );

        return $this;
    }
}
