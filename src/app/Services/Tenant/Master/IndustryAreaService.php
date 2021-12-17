<?php

namespace App\Services\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Master\IndustryArea;
use App\Services\Tenant\TenantService;

class IndustryAreaService extends TenantService
{
    public function __construct(IndustryArea $industryArea)
    {
        $this->model = $industryArea;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'name' => 'required|min:2',
        ])->validate();

        return $this;
    }

    public function validateIndustryAreas(): IndustryAreaService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasIndustryArea(),
            new GeneralException(__t('you_cant_update_industry_area_if_the_type_already_has_industry_area_applied'))
        );

        return $this;
    }
}
