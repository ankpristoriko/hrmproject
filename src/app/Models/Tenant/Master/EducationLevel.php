<?php

namespace App\Models\Tenant\Master;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class EducationLevel extends TenantModel
{
    protected $table = 'education_levels';
    protected $fillable = ['name'];

    public function hasEducation($expect = null): int
    {
        return $this->educations()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof EducationLevel,
                    fn(Builder $bl) => $bl->where('education_level_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('education_level_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('education_level_id', '!=', resolve(StatusRepository::class)->educationLevelRejected());
            })->count();
    }
}
