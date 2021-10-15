<?php

namespace App\Models\Tenant\Master;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class AwardType extends TenantModel
{
    protected $table = 'award_types';
    protected $fillable = ['name'];

    public function hasAward($expect = null): int
    {
        return $this->awards()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof AwardType,
                    fn(Builder $bl) => $bl->where('award_type_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('award_type_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('award_type_id', '!=', resolve(StatusRepository::class)->awardRejected());
            })->count();
    }
}
