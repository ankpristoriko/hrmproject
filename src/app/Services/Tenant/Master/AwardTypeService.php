<?php

namespace App\Services\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Master\AwardType;
use App\Services\Tenant\TenantService;

class AwardTypeService extends TenantService
{
    public function __construct(AwardType $awardType)
    {
        $this->model = $awardType;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'name' => 'required|min:2',
        ])->validate();

        return $this;
    }

    public function validateAwards(): AwardTypeService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasAward(),
            new GeneralException(__t('you_cant_update_award_type_if_the_type_already_has_award_applied'))
        );

        return $this;
    }
}
