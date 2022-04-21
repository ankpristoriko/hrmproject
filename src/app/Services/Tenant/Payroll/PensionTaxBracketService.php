<?php

namespace App\Services\Tenant\Payroll;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Payroll\PensionTaxBracket;
use App\Services\Tenant\TenantService;

class PensionTaxBracketService extends TenantService
{
    public function __construct(PensionTaxBracket $pensionTaxBracket)
    {
        $this->model = $pensionTaxBracket;
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

    public function validatePensionTaxBrackets(): PensionTaxBracketService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasPensionTaxBracket(),
            new GeneralException(__t('you_cant_update_pension_tax_bracket_if_the_type_already_has_pension_tax_bracket_applied'))
        );

        return $this;
    }
}
