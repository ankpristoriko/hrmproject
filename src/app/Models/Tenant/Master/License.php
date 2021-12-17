<?php

namespace App\Models\Tenant\Master;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class License extends TenantModel
{
    protected $table = 'licenses';
    protected $fillable = ['name','description'];

    public function hasLicense($expect = null): int
    {
        return $this->licenses()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof License,
                    fn(Builder $bl) => $bl->where('license_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('license_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('license_id', '!=', resolve(StatusRepository::class)->licenseRejected());
            })->count();
    }
}
