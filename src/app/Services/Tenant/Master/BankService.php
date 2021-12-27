<?php

namespace App\Services\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Master\Bank;
use App\Services\Tenant\TenantService;

class BankService extends TenantService
{
    public function __construct(Bank $bank)
    {
        $this->model = $bank;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'name' => 'required|min:2',
        ])->validate();

        return $this;
    }

    public function validateBanks(): BankService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasBank(),
            new GeneralException(__t('you_cant_update_bank_if_the_type_already_has_bank_applied'))
        );

        return $this;
    }
}
