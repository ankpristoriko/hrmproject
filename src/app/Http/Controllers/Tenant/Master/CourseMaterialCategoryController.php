<?php

namespace App\Http\Controllers\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Master\CourseMaterialCategory;
use App\Filters\Tenant\Master\CourseMaterialCategoryFilter;
use App\Services\Tenant\Master\CourseMaterialCategoryService;

class CourseMaterialCategoryController extends Controller
{
    public function __construct(CourseMaterialCategoryService $service, CourseMaterialCategoryFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return CourseMaterialCategory::filters($this->filter)
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(CourseMaterialCategory $courseMaterialCategory)
    {
        return $courseMaterialCategory;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('name','description'))
            ->validate()
            ->save();

        return created_responses('course_material_category');
    }

    public function update(Request $request, CourseMaterialCategory $courseMaterialCategory)
    {
        $this->service
            ->setModel($courseMaterialCategory)
            ->setAttributes($request->only('name','description'))
            ->validate()
            ->validateCourseMaterialCategories()
            ->save();

        return updated_responses('course_material_category');
    }

    public function destroy(CourseMaterialCategory $courseMaterialCategory)
    {
        try {
            $courseMaterialCategory->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_course_material_category'));
        }

        return deleted_responses('course_material_category');       
    }
}