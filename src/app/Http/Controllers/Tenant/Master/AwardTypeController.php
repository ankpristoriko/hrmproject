<?php

namespace App\Http\Controllers\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Master\AwardType;
use App\Filters\Tenant\Master\AwardTypeFilter;
use App\Services\Tenant\Master\AwardTypeService;

class AwardTypeController extends Controller
{
    public function __construct(AwardTypeService $service, AwardTypeFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return AwardType::filters($this->filter)
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(AwardType $awardType)
    {
        return $awardType;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('name'))
            ->validate()
            ->save();

        return created_responses('award_type');
    }

    public function update(Request $request, AwardType $awardType)
    {
        $this->service
            ->setModel($awardType)
            ->setAttributes($request->only('name'))
            ->validate()
            ->validateAwards()
            ->save();

        return updated_responses('award_type');
    }

    public function destroy(AwardType $awardType)
    {
        try {
            $awardType->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_award_type'));
        }

        return deleted_responses('award_type');       
    }
}