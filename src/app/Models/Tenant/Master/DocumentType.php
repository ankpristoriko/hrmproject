<?php

namespace App\Models\Tenant\Master;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class DocumentType extends TenantModel
{
    protected $table = 'document_types';
    protected $fillable = ['name'];

    public function hasDocument($expect = null): int
    {
        return $this->documents()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof DocumentType,
                    fn(Builder $bl) => $bl->where('document_type_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('document_type_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('document_type_id', '!=', resolve(StatusRepository::class)->documentRejected());
            })->count();
    }
}
