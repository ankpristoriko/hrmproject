<?php

namespace App\Http\Controllers\Tenant\Training;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Training\TrainingInstitution;
use App\Filters\Tenant\Training\TrainingInstitutionFilter;
use App\Services\Tenant\Training\TrainingInstitutionService;

class TrainingInstitutionController extends Controller
{
    public function __construct(TrainingInstitutionService $service, TrainingInstitutionFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return TrainingInstitution::filters($this->filter)
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(TrainingInstitution $trainingInstitution)
    {
        return $trainingInstitution;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('name','contact_name','phone_number','email','address','country','valid_from','valid_to'))
            ->validate()
            ->save();

        return created_responses('training_institution');
    }

    public function update(Request $request, TrainingInstitution $trainingInstitution)
    {
        $this->service
            ->setModel($trainingInstitution)
            ->setAttributes($request->only('name','contact_name','phone_number','email','address','country','valid_from','valid_to'))
            ->validate()
            ->validateTrainingInstitutions()
            ->save();

        return updated_responses('training_institution');
    }

    public function destroy(TrainingInstitution $trainingInstitution)
    {
        try {
            $trainingInstitution->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_training_institution'));
        }

        return deleted_responses('training_institution');       
    }
}