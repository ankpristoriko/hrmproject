<?php

namespace App\Http\Controllers\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Master\WarningType;
use App\Filters\Tenant\Master\WarningTypeFilter;
use App\Services\Tenant\Master\WarningTypeService;

class WarningTypeController extends Controller
{
    public function __construct(WarningTypeService $service, WarningTypeFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return WarningType::filters($this->filter)
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(WarningType $warningType)
    {
        return $warningType;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('name'))
            ->validate()
            ->save();

        return created_responses('warning_type');
    }

    public function update(Request $request, WarningType $warningType)
    {
        $this->service
            ->setModel($warningType)
            ->setAttributes($request->only('name'))
            ->validate()
            ->validateWarnings()
            ->save();

        return updated_responses('warning_type');
    }

    public function destroy(WarningType $warningType)
    {
        try {
            $warningType->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_warning_type'));
        }

        return deleted_responses('warning_type');       
    }
}