<?php

namespace App\Http\Controllers\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Master\CourseCategory;
use App\Filters\Tenant\Master\CourseCategoryFilter;
use App\Services\Tenant\Master\CourseCategoryService;

class CourseCategoryController extends Controller
{
    public function __construct(CourseCategoryService $service, CourseCategoryFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return CourseCategory::filters($this->filter)
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(CourseCategory $courseCategory)
    {
        return $courseCategory;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('code','name','description'))
            ->validate()
            ->save();

        return created_responses('course_category');
    }

    public function update(Request $request, CourseCategory $courseCategory)
    {
        $this->service
            ->setModel($courseCategory)
            ->setAttributes($request->only('code','name','description'))
            ->validate()
            ->validateCourseCategories()
            ->save();

        return updated_responses('course_category');
    }

    public function destroy(CourseCategory $courseCategory)
    {
        try {
            $courseCategory->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_course_category'));
        }

        return deleted_responses('course_category');       
    }
}