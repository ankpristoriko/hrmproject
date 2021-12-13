<?php

namespace App\Http\Controllers\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Master\Ethnicity;
use App\Filters\Tenant\Master\EthnicityFilter;
use App\Services\Tenant\Master\EthnicityService;

class EthnicityController extends Controller
{
    public function __construct(EthnicityService $service, EthnicityFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return Ethnicity::filters($this->filter)
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(Ethnicity $ethnicity)
    {
        return $ethnicity;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('name'))
            ->validate()
            ->save();

        return created_responses('ethnicity');
    }

    public function update(Request $request, Ethnicity $ethnicity)
    {
        $this->service
            ->setModel($ethnicity)
            ->setAttributes($request->only('name'))
            ->validate()
            ->validateEthnicities()
            ->save();

        return updated_responses('ethnicity');
    }

    public function destroy(Ethnicity $ethnicity)
    {
        try {
            $ethnicity->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_ethnicity'));
        }

        return deleted_responses('ethnicity');       
    }
}