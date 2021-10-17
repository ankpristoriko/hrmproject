<?php

namespace App\Models\Tenant\Recruitment;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class Stage extends TenantModel
{
    protected $table = 'stages';
    protected $fillable = ['name'];

    public function hasStage($expect = null): int
    {
        return $this->stages()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof Stage,
                    fn(Builder $bl) => $bl->where('stage_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('stage_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('stage_id', '!=', resolve(StatusRepository::class)->stageRejected());
            })->count();
    }
}
