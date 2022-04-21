<?php

namespace App\Models\Tenant\Payroll;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class SeverancePayTaxBracket extends TenantModel
{
    protected $table = 'taxes';
    protected $fillable = ['key','lower_gross_annual_income','upper_gross_annual_income','tax_deducted_rate','currency'];

    public function hasSeverancePayTaxBracket($expect = null): int
    {
        return $this->severancePayTaxBrackets()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof TaxBracket,
                    fn(Builder $bl) => $bl->where('severance_pay_tax_bracket_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('severance_pay_tax_bracket_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('severance_pay_tax_bracket_id', '!=', resolve(StatusRepository::class)->severancePayTaxBracketRejected());
            })->count();
    }
}
