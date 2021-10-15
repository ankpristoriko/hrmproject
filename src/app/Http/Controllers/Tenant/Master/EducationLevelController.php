<?php

namespace App\Http\Controllers\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Master\EducationLevel;
use App\Filters\Tenant\Master\EducationLevelFilter;
use App\Services\Tenant\Master\EducationLevelService;

class EducationLevelController extends Controller
{
    public function __construct(EducationLevelService $service, EducationLevelFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return EducationLevel::filters($this->filter)
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(EducationLevel $educationLevel)
    {
        return $educationLevel;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('name'))
            ->validate()
            ->save();

        return created_responses('education_level');
    }

    public function update(Request $request, EducationLevel $educationLevel)
    {
        $this->service
            ->setModel($educationLevel)
            ->setAttributes($request->only('name'))
            ->validate()
            ->validateEducationLevels()
            ->save();

        return updated_responses('education_level');
    }

    public function destroy(EducationLevel $educationLevel)
    {
        try {
            $educationLevel->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_education_level'));
        }

        return deleted_responses('education_level');       
    }
}