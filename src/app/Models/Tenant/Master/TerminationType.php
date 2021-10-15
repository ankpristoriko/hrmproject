<?php

namespace App\Models\Tenant\Master;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class TerminationType extends TenantModel
{
    protected $table = 'termination_types';
    protected $fillable = ['name'];

    public function hasTermination($expect = null): int
    {
        return $this->terminations()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof TerminationType,
                    fn(Builder $bl) => $bl->where('termination_type_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('termination_type_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('termination_type_id', '!=', resolve(StatusRepository::class)->terminationRejected());
            })->count();
    }
}
