<?php

namespace App\Services\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Master\TrainingType;
use App\Services\Tenant\TenantService;

class TrainingTypeService extends TenantService
{
    public function __construct(TrainingType $trainingType)
    {
        $this->model = $trainingType;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'name' => 'required|min:2',
        ])->validate();

        return $this;
    }

    public function validateTrainings(): TrainingTypeService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasTraining(),
            new GeneralException(__t('you_cant_update_training_type_if_the_type_already_has_training_applied'))
        );

        return $this;
    }
}
