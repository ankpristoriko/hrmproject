<?php

namespace App\Models\Tenant\Recruitment;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class JobType extends TenantModel
{
    protected $table = 'job_types';
    protected $fillable = ['name','brief'];

    public function hasJobType($expect = null): int
    {
        return $this->jobTypes()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof JobType,
                    fn(Builder $bl) => $bl->where('job_type_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('job_type_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('job_type_id', '!=', resolve(StatusRepository::class)->jobTypeRejected());
            })->count();
    }
}
