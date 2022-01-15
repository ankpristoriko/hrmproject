<?php

namespace App\Models\Tenant\Training;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class TrainingInstitution extends TenantModel
{
    protected $table = 'training_institutions';
    protected $fillable = ['name','contact_name','phone_number','email','address','country','valid_from','valid_to'];

    public function hasTrainingInstitution($expect = null): int
    {
        return $this->trainingInstitution()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof TrainingInstitution,
                    fn(Builder $bl) => $bl->where('training_institution_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('training_institution_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('training_institution_id', '!=', resolve(StatusRepository::class)->trainingInstitutionRejected());
            })->count();
    }
}
