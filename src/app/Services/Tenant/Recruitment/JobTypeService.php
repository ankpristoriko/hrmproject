<?php

namespace App\Services\Tenant\Recruitment;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Recruitment\JobType;
use App\Services\Tenant\TenantService;

class JobTypeService extends TenantService
{
    public function __construct(JobType $jobType)
    {
        $this->model = $jobType;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'name' => 'required|min:2',
        ])->validate();

        return $this;
    }

    public function validateJobTypes(): JobTypeService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasJobType(),
            new GeneralException(__t('you_cant_update_job_type_if_the_type_already_has_job_applied'))
        );

        return $this;
    }
}
