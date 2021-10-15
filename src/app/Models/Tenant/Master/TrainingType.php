<?php

namespace App\Models\Tenant\Master;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class TrainingType extends TenantModel
{
    protected $table = 'training_types';
    protected $fillable = ['name'];

    public function hasTraining($expect = null): int
    {
        return $this->trainings()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof TrainingType,
                    fn(Builder $bl) => $bl->where('training_type_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('training_type_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('training_type_id', '!=', resolve(StatusRepository::class)->trainingRejected());
            })->count();
    }
}
