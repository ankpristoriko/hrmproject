<?php

namespace App\Http\Controllers\Tenant\Payroll;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Payroll\TaxBracket;
use App\Filters\Tenant\Payroll\TaxBracketFilter;
use App\Services\Tenant\Payroll\TaxBracketService;

class TaxBracketController extends Controller
{
    public function __construct(TaxBracketService $service, TaxBracketFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return TaxBracket::filters($this->filter)
            ->where('key','tax_bracket')
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(TaxBracket $taxBracket)
    {
        return $taxBracket;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('key'))
            ->validate()
            ->save();

        return created_responses('tax_bracket');
    }

    public function update(Request $request, TaxBracket $taxBracket)
    {
        $this->service
            ->setModel($taxBracket)
            ->setAttributes($request->only('key'))
            ->validate()
            ->validateTaxBrackets()
            ->save();

        return updated_responses('tax_bracket');
    }

    public function destroy(TaxBracket $taxBracket)
    {
        try {
            $taxBracket->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_tax_bracket'));
        }

        return deleted_responses('tax_bracket');       
    }
}