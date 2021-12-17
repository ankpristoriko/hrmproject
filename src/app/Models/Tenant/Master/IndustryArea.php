<?php

namespace App\Models\Tenant\Master;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class IndustryArea extends TenantModel
{
    protected $table = 'industry_areas';
    protected $fillable = ['name','description'];

    public function hasIndustryArea($expect = null): int
    {
        return $this->industryAreas()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof IndustryArea,
                    fn(Builder $bl) => $bl->where('industry_area_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('industry_area_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('industry_area_id', '!=', resolve(StatusRepository::class)->industryAreaRejected());
            })->count();
    }
}
