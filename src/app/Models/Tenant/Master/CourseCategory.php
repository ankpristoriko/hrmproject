<?php

namespace App\Models\Tenant\Master;

use App\Models\Tenant\TenantModel;
use Illuminate\Database\Eloquent\Builder;

class CourseCategory extends TenantModel
{
    protected $table = 'course_categories';
    protected $fillable = ['code','name','description'];

    public function hasCourseCategory($expect = null): int
    {
        return $this->courseCategories()
            ->when($expect, function (Builder $builder) use ($expect) {
                $builder->when(
                    $expect instanceof CourseCategory,
                    fn(Builder $bl) => $bl->where('course_category_id', '!=', $expect->id),
                    fn(Builder $bl) => $bl->where('course_category_id', '!=', $expect),
                );
            }, function (Builder $builder) {
                $builder->where('course_category_id', '!=', resolve(StatusRepository::class)->courseCategoryRejected());
            })->count();
    }
}
