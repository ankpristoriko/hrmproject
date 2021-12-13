<?php

namespace App\Models\Tenant\Master;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class Ethnicity extends TenantModel
{
    protected $table = 'ethnicities';
    protected $fillable = ['name'];

    public function hasEthnicity($expect = null): int
    {
        return $this->ethnicities()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof Ethnicity,
                    fn(Builder $bl) => $bl->where('ethnicity_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('ethnicity_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('ethnicity_id', '!=', resolve(StatusRepository::class)->ethnicityRejected());
            })->count();
    }
}
