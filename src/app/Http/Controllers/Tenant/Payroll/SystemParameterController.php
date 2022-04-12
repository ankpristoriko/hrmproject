<?php

namespace App\Http\Controllers\Tenant\Payroll;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Payroll\SystemParameter;
use App\Filters\Tenant\Payroll\SystemParameterFilter;
use App\Services\Tenant\Payroll\SystemParameterService;

class SystemParameterController extends Controller
{
    public function __construct(SystemParameterService $service, SystemParameterFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return SystemParameter::filters($this->filter)
            ->where('key','system_parameter')
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(SystemParameter $systemParameter)
    {
        return $systemParameter;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('parameter_code'))
            ->validate()
            ->save();

        return created_responses('system_parameter');
    }

    public function update(Request $request, SystemParameter $systemParameter)
    {
        $this->service
            ->setModel($systemParameter)
            ->setAttributes($request->only('parameter_code'))
            ->validate()
            ->validateDocuments()
            ->save();

        return updated_responses('system_parameter');
    }

    public function destroy(SystemParameter $systemParameter)
    {
        try {
            $systemParameter->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_system_parameter'));
        }

        return deleted_responses('document_type');       
    }
}