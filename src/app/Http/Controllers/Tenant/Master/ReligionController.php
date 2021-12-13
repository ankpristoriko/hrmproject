<?php

namespace App\Http\Controllers\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Master\Religion;
use App\Filters\Tenant\Master\ReligionFilter;
use App\Services\Tenant\Master\ReligionService;

class ReligionController extends Controller
{
    public function __construct(ReligionService $service, ReligionFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return Religion::filters($this->filter)
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(Religion $religion)
    {
        return $religion;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('name'))
            ->validate()
            ->save();

        return created_responses('religion');
    }

    public function update(Request $request, Religion $religion)
    {
        $this->service
            ->setModel($religion)
            ->setAttributes($request->only('name'))
            ->validate()
            ->validateReligions()
            ->save();

        return updated_responses('religion');
    }

    public function destroy(Religion $religion)
    {
        try {
            $religion->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_religion'));
        }

        return deleted_responses('religion');       
    }
}