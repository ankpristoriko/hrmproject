<?php

namespace App\Models\Tenant\Master;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class CourseMaterialCategory extends TenantModel
{
    protected $table = 'course_material_categories';
    protected $fillable = ['name','description'];

    public function hasCourseMaterialCategory($expect = null): int
    {
        return $this->courseMaterialCategories()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof CourseMaterialCategory,
                    fn(Builder $bl) => $bl->where('course_material_category_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('course_material__category_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('course_material__category_id', '!=', resolve(StatusRepository::class)->courseMaterialCategoryRejected());
            })->count();
    }
}
