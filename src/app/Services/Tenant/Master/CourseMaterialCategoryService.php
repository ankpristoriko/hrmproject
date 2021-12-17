<?php

namespace App\Services\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Master\CourseMaterialCategory;
use App\Services\Tenant\TenantService;

class CourseMaterialCategoryService extends TenantService
{
    public function __construct(CourseMaterialCategory $courseMaterialCategory)
    {
        $this->model = $courseMaterialCategory;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'name' => 'required|min:2',
        ])->validate();

        return $this;
    }

    public function validateCourseMaterialCategories(): CourseMaterialCategoryService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasCourseMaterialCategory(),
            new GeneralException(__t('you_cant_update_course_material_category_if_the_type_already_has_course_material_category_applied'))
        );

        return $this;
    }
}
