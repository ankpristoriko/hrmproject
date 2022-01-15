<?php

namespace App\Services\Tenant\Training;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Training\TrainingInstitution;
use App\Services\Tenant\TenantService;

class TrainingInstitutionService extends TenantService
{
    public function __construct(TrainingInstitution $trainingInstitution)
    {
        $this->model = $trainingInstitution;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'name' => 'required|min:2',
        ])->validate();

        return $this;
    }

    public function validateTrainingInstitutions(): TrainingInstitutionService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasTrainingInstitution(),
            new GeneralException(__t('you_cant_update_training_institution_if_the_type_already_has_training_institution_applied'))
        );

        return $this;
    }
}
