<?php

namespace App\Services\Tenant\Recruitment;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Recruitment\Stage;
use App\Services\Tenant\TenantService;

class StageService extends TenantService
{
    public function __construct(Stage $stage)
    {
        $this->model = $stage;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'name' => 'required|min:2',
        ])->validate();

        return $this;
    }

    public function validateStages(): StageService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasStage(),
            new GeneralException(__t('you_cant_update_stage_if_the_type_already_has_stage_applied'))
        );

        return $this;
    }
}
