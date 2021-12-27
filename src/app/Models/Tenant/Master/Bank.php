<?php

namespace App\Models\Tenant\Master;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class Bank extends TenantModel
{
    protected $table = 'banks';
    protected $fillable = ['name'];

    public function hasBank($expect = null): int
    {
        return $this->banks()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof Bank,
                    fn(Builder $bl) => $bl->where('bank_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('bank_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('bank_id', '!=', resolve(StatusRepository::class)->bankRejected());
            })->count();
    }
}
