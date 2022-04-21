<?php

namespace App\Services\Tenant\Payroll;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Payroll\SeverancePayTaxBracket;
use App\Services\Tenant\TenantService;

class SeverancePayTaxBracketService extends TenantService
{
    public function __construct(SeverancePayTaxBracket $severancePayTaxBracket)
    {
        $this->model = $severancePayTaxBracket;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'key' => 'required|min:2',
            'lower_gross_annual_income' => 'required',
            'upper_gross_annual_income' => 'required',
            'tax_deducted_rate' => 'required',
        ])->validate();

        return $this;
    }

    public function validateSeverancePayTaxBrackets(): SeverancePayTaxBracketService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasSeverancePayTaxBracket(),
            new GeneralException(__t('you_cant_update_severance_pay_tax_bracket_if_the_type_already_has_severance_pay_tax_bracket_applied'))
        );

        return $this;
    }
}
