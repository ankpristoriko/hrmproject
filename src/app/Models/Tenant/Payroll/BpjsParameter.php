<?php

namespace App\Models\Tenant\Payroll;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class BpjsParameter extends TenantModel
{
    protected $table = 'parameters';
    protected $fillable = ['parameter_code','decription','parameter_value','valid_from','valid_to'];

    public function hasBpjsParameter($expect = null): int
    {
        return $this->bpjsParameters()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof BpjsParameter,
                    fn(Builder $bl) => $bl->where('bpjs_parameter_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('bpjs_parameter_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('bpjs_parameter_id', '!=', resolve(StatusRepository::class)->bpjsParameterRejected());
            })->count();
    }
}
