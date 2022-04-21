<?php

namespace App\Services\Tenant\Payroll;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Payroll\NonNpwpTaxBracket;
use App\Services\Tenant\TenantService;

class NonNpwpTaxBracketService extends TenantService
{
    public function __construct(NonNpwpTaxBracket $nonNpwpTaxBracket)
    {
        $this->model = $nonNpwpTaxBracket;
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

    public function validateNonNpwpTaxBrackets(): NonNpwpTaxBracketService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasTaxBracket(),
            new GeneralException(__t('you_cant_update_non_npwp_tax_bracket_if_the_type_already_has_non_npwp_tax_bracket_applied'))
        );

        return $this;
    }
}
