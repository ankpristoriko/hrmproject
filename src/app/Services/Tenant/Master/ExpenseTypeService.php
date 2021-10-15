<?php

namespace App\Services\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Master\ExpenseType;
use App\Services\Tenant\TenantService;

class ExpenseTypeService extends TenantService
{
    public function __construct(ExpenseType $expenseType)
    {
        $this->model = $expenseType;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'name' => 'required|min:2',
        ])->validate();

        return $this;
    }

    public function validateExpenses(): ExpenseTypeService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasExpense(),
            new GeneralException(__t('you_cant_update_expense_type_if_the_type_already_has_expense_applied'))
        );

        return $this;
    }
}
