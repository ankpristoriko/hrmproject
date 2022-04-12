<?php

namespace App\Models\Tenant\Payroll;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class SystemParameter extends TenantModel
{
    protected $table = 'parameters';
    protected $fillable = ['parameter_code','decription','parameter_value','valid_from','valid_to'];

    public function hasSystemParameter($expect = null): int
    {
        return $this->systemParameters()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof SystemParameter,
                    fn(Builder $bl) => $bl->where('system_parameter_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('system_parameter_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('system_parameter_id', '!=', resolve(StatusRepository::class)->systemParameterRejected());
            })->count();
    }
}
