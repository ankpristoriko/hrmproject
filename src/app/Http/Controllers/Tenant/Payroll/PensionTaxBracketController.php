<?php

namespace App\Http\Controllers\Tenant\Payroll;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Payroll\PensionTaxBracket;
use App\Filters\Tenant\Payroll\PensionTaxBracketFilter;
use App\Services\Tenant\Payroll\PensionTaxBracketService;

class PensionTaxBracketController extends Controller
{
    public function __construct(PensionTaxBracketService $service, PensionTaxBracketFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return PensionTaxBracket::filters($this->filter)
            ->where('key','pension_tax_bracket')
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(PensionTaxBracket $pensionTaxBracket)
    {
        return $pensionTaxBracket;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('key'))
            ->validate()
            ->save();

        return created_responses('pension_tax_bracket');
    }

    public function update(Request $request, PensionTaxBracket $pensionTaxBracket)
    {
        $this->service
            ->setModel($pensionTaxBracket)
            ->setAttributes($request->only('key'))
            ->validate()
            ->validatePensionTaxBrackets()
            ->save();

        return updated_responses('pension_tax_bracket');
    }

    public function destroy(PensionTaxBracket $pensionTaxBracket)
    {
        try {
            $pensionTaxBracket->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_pension_tax_bracket'));
        }

        return deleted_responses('pension_tax_bracket');       
    }
}