<?php

namespace App\Models\Tenant\Master;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class Relationship extends TenantModel
{
    protected $table = 'relationships';
    protected $fillable = ['name'];

    public function hasRelationship($expect = null): int
    {
        return $this->relationships()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof Relationship,
                    fn(Builder $bl) => $bl->where('relationship_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('relationship_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('relationship_id', '!=', resolve(StatusRepository::class)->relationshipRejected());
            })->count();
    }
}
