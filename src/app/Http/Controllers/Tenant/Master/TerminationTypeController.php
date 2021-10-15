<?php

namespace App\Http\Controllers\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Master\TerminationType;
use App\Filters\Tenant\Master\TerminationTypeFilter;
use App\Services\Tenant\Master\TerminationTypeService;

class TerminationTypeController extends Controller
{
    public function __construct(TerminationTypeService $service, TerminationTypeFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return TerminationType::filters($this->filter)
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(TerminationType $terminationType)
    {
        return $terminationType;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('name'))
            ->validate()
            ->save();

        return created_responses('termination_type');
    }

    public function update(Request $request, TerminationType $terminationType)
    {
        $this->service
            ->setModel($terminationType)
            ->setAttributes($request->only('name'))
            ->validate()
            ->validateTerminations()
            ->save();

        return updated_responses('termination_type');
    }

    public function destroy(TerminationType $terminationType)
    {
        try {
            $terminationType->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_termination_type'));
        }

        return deleted_responses('termination_type');       
    }
}