<?php

namespace App\Http\Controllers\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Master\EducationalInstitution;
use App\Filters\Tenant\Master\EducationalInstitutionFilter;
use App\Services\Tenant\Master\EducationalInstitutionService;

class EducationalInstitutionController extends Controller
{
    public function __construct(EducationalInstitutionService $service, EducationalInstitutionFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return EducationalInstitution::filters($this->filter)
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(EducationalInstitution $educationalInstitution)
    {
        return $educationalInstitution;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('name','address'))
            ->validate()
            ->save();

        return created_responses('educational_institution');
    }

    public function update(Request $request, EducationalInstitution $educationalInstitution)
    {
        $this->service
            ->setModel($educationalInstitution)
            ->setAttributes($request->only('name','address'))
            ->validate()
            ->validateEducationalInstitutions()
            ->save();

        return updated_responses('educational_institution');
    }

    public function destroy(EducationalInstitution $educationalInstitution)
    {
        try {
            $educationalInstitution->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_educational_institution'));
        }

        return deleted_responses('educational_institution');       
    }
}