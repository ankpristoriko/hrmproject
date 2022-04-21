<?php

namespace App\Http\Controllers\Tenant\Payroll;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Payroll\BpjsParameter;
use App\Filters\Tenant\Payroll\BpjsParameterFilter;
use App\Services\Tenant\Payroll\BpjsParameterService;

class BpjsParameterController extends Controller
{
    public function __construct(BpjsParameterService $service, BpjsParameterFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return BpjsParameter::filters($this->filter)
            ->where('key','bpjs_parameter')
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(BpjsParameter $bpjsParameter)
    {
        return $bpjsParameter;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('parameter_code'))
            ->validate()
            ->save();

        return created_responses('bpjs_parameter');
    }

    public function update(Request $request, BpjsParameter $bpjsParameter)
    {
        $this->service
            ->setModel($bpjsParameter)
            ->setAttributes($request->only('parameter_code'))
            ->validate()
            ->validateBpjsParameters()
            ->save();

        return updated_responses('bpjs_parameter');
    }

    public function destroy(BpjsParameter $bpjsParameter)
    {
        try {
            $bpjsParameter->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_bpjs_parameter'));
        }

        return deleted_responses('bpjs_parameter');       
    }
}