<?php

namespace App\Services\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Master\License;
use App\Services\Tenant\TenantService;

class LicenseService extends TenantService
{
    public function __construct(License $license)
    {
        $this->model = $license;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'name' => 'required|min:2',
        ])->validate();

        return $this;
    }

    public function validateLicenses(): LicenseService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasLicense(),
            new GeneralException(__t('you_cant_update_license_if_the_type_already_has_license_applied'))
        );

        return $this;
    }
}
