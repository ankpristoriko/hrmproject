<?php

namespace App\Services\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Master\CourseCategory;
use App\Services\Tenant\TenantService;

class CourseCategoryService extends TenantService
{
    public function __construct(CourseCategory $courseCategory)
    {
        $this->model = $courseCategory;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'name' => 'required|min:2',
        ])->validate();

        return $this;
    }

    public function validateCourseCategories(): CourseCategoryService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasCourseCategory(),
            new GeneralException(__t('you_cant_update_course_category_if_the_type_already_has_course_category_applied'))
        );

        return $this;
    }
}
