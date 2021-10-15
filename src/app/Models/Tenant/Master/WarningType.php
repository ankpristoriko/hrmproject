<?php

namespace App\Models\Tenant\Master;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class WarningType extends TenantModel
{
    protected $table = 'warning_types';
    protected $fillable = ['name'];

    public function hasWarning($expect = null): int
    {
        return $this->warnings()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof WarningType,
                    fn(Builder $bl) => $bl->where('warning_type_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('warning_type_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('warning_type_id', '!=', resolve(StatusRepository::class)->warningRejected());
            })->count();
    }
}
