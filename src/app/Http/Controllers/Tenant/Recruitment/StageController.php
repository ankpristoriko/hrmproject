<?php

namespace App\Http\Controllers\Tenant\Recruitment;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Recruitment\Stage;
use App\Filters\Tenant\Recruitment\StageFilter;
use App\Services\Tenant\Recruitment\StageService;

class StageController extends Controller
{
    public function __construct(StageService $service, StageFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return Stage::filters($this->filter)
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(Stage $stage)
    {
        return $stage;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('name'))
            ->validate()
            ->save();

        return created_responses('stage');
    }

    public function update(Request $request, Stage $stage)
    {
        $this->service
            ->setModel($stage)
            ->setAttributes($request->only('name'))
            ->validate()
            ->validateStages()
            ->save();

        return updated_responses('stage');
    }

    public function destroy(Stage $stage)
    {
        try {
            $stage->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_stage'));
        }

        return deleted_responses('stage');       
    }
}