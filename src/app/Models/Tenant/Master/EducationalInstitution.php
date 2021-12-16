<?php

namespace App\Models\Tenant\Master;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class EducationalInstitution extends TenantModel
{
    protected $table = 'educational_institutions';
    protected $fillable = ['name','address'];

    public function hasEducationalInstitution($expect = null): int
    {
        return $this->educationInstitutions()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof EducationalInstitution,
                    fn(Builder $bl) => $bl->where('educational_institution_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('educational_institution_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('educational_institution_id', '!=', resolve(StatusRepository::class)->educationalInstitutionRejected());
            })->count();
    }
}
