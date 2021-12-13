<?php

namespace App\Models\Tenant\Master;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class Religion extends TenantModel
{
    protected $table = 'religions';
    protected $fillable = ['name'];

    public function hasReligion($expect = null): int
    {
        return $this->religions()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof Religion,
                    fn(Builder $bl) => $bl->where('religion_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('religion_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('religion_id', '!=', resolve(StatusRepository::class)->religionRejected());
            })->count();
    }
}
