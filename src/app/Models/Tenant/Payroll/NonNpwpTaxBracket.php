<?php

namespace App\Models\Tenant\Payroll;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class NonNpwpTaxBracket extends TenantModel
{
    protected $table = 'taxes';
    protected $fillable = ['key','lower_gross_annual_income','upper_gross_annual_income','tax_deducted_rate','currency'];

    public function hasNonNpwpTaxBracket($expect = null): int
    {
        return $this->nonNpwpTaxBrackets()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof TaxBracket,
                    fn(Builder $bl) => $bl->where('non_npwp_tax_bracket_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('non_npwp_tax_bracket_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('non_npwp_tax_bracket_id', '!=', resolve(StatusRepository::class)->nonNpwpTaxBracketRejected());
            })->count();
    }
}
