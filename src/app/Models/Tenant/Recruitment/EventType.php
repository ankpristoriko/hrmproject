<?php

namespace App\Models\Tenant\Recruitment;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class EventType extends TenantModel
{
    protected $table = 'event_types';
    protected $fillable = ['name','brief'];

    public function hasEvent($expect = null): int
    {
        return $this->events()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof EventType,
                    fn(Builder $bl) => $bl->where('event_type_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('event_type_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('event_type_id', '!=', resolve(StatusRepository::class)->eventRejected());
            })->count();
    }
}
