<?php

namespace App\Http\Controllers\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Master\IndustryArea;
use App\Filters\Tenant\Master\IndustryAreaFilter;
use App\Services\Tenant\Master\IndustryAreaService;

class IndustryAreaController extends Controller
{
    public function __construct(IndustryAreaService $service, IndustryAreaFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return IndustryArea::filters($this->filter)
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(IndustryArea $industryArea)
    {
        return $industryArea;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('name','description'))
            ->validate()
            ->save();

        return created_responses('industry_area');
    }

    public function update(Request $request, IndustryArea $industryArea)
    {
        $this->service
            ->setModel($industryArea)
            ->setAttributes($request->only('name','description'))
            ->validate()
            ->validateIndustryAreas()
            ->save();

        return updated_responses('industry_area');
    }

    public function destroy(IndustryArea $industryArea)
    {
        try {
            $industryArea->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_industry_area'));
        }

        return deleted_responses('industry_area');       
    }
}