<?php

namespace App\Models\Tenant\Master;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class ExpenseType extends TenantModel
{
    protected $table = 'expense_types';
    protected $fillable = ['name'];

    public function hasExpense($expect = null): int
    {
        return $this->expenses()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof ExpenseType,
                    fn(Builder $bl) => $bl->where('expense_type_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('expense_type_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('expense_type_id', '!=', resolve(StatusRepository::class)->expenseRejected());
            })->count();
    }
}
