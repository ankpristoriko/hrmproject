<?php

namespace App\Http\Controllers\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Master\TrainingType;
use App\Filters\Tenant\Master\TrainingTypeFilter;
use App\Services\Tenant\Master\TrainingTypeService;

class TrainingTypeController extends Controller
{
    public function __construct(TrainingTypeService $service, TrainingTypeFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return TrainingType::filters($this->filter)
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(TrainingType $trainingType)
    {
        return $trainingType;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('name'))
            ->validate()
            ->save();

        return created_responses('training_type');
    }

    public function update(Request $request, TrainingType $trainingType)
    {
        $this->service
            ->setModel($trainingType)
            ->setAttributes($request->only('name'))
            ->validate()
            ->validateTrainings()
            ->save();

        return updated_responses('training_type');
    }

    public function destroy(TrainingType $trainingType)
    {
        try {
            $trainingType->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_training_type'));
        }

        return deleted_responses('training_type');       
    }
}