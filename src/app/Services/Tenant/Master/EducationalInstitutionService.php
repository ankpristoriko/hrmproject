<?php

namespace App\Services\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Master\EducationalInstitution;
use App\Services\Tenant\TenantService;

class EducationalInstitutionService extends TenantService
{
    public function __construct(EducationalInstitution $educationalInstitution)
    {
        $this->model = $educationalInstitution;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'name' => 'required|min:2',
            'address' => 'nullable'
        ])->validate();

        return $this;
    }

    public function validateEducationalInstitutions(): EducationalInstitutionService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasEducation(),
            new GeneralException(__t('you_cant_update_educational_institution_if_the_type_already_has_educational_applied'))
        );

        return $this;
    }
}
