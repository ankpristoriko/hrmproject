<?php

namespace App\Http\Controllers\Tenant\Payroll;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Payroll\SeverancePayTaxBracket;
use App\Filters\Tenant\Payroll\SeverancePayTaxBracketFilter;
use App\Services\Tenant\Payroll\SeverancePayTaxBracketService;

class SeverancePayTaxBracketController extends Controller
{
    public function __construct(SeverancePayTaxBracketService $service, SeverancePayTaxBracketFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return SeverancePayTaxBracket::filters($this->filter)
            ->where('key','severance_pay_tax_bracket')
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(SeverancePayTaxBracket $severancePayTaxBracket)
    {
        return $severancePayTaxBracket;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('key'))
            ->validate()
            ->save();

        return created_responses('severance_pay_tax_bracket');
    }

    public function update(Request $request, SeverancePayTaxBracket $severancePayTaxBracket)
    {
        $this->service
            ->setModel($severancePayTaxBracket)
            ->setAttributes($request->only('key'))
            ->validate()
            ->validateSeverancePayTaxBrackets()
            ->save();

        return updated_responses('tax_bracket');
    }

    public function destroy(SeverancePayTaxBracket $severancePaxBracket)
    {
        try {
            $severancePaxBracket->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_severance_pay_tax_bracket'));
        }

        return deleted_responses('severance_pay_tax_bracket');       
    }
}