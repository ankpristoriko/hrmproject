<?php

namespace App\Http\Controllers\Tenant\Payroll;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Payroll\NonNpwpTaxBracket;
use App\Filters\Tenant\Payroll\NonNpwpTaxBracketFilter;
use App\Services\Tenant\Payroll\NonNpwpTaxBracketService;

class NonNpwpTaxBracketController extends Controller
{
    public function __construct(NonNpwpTaxBracketService $service, NonNpwpTaxBracketFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return NonNpwpTaxBracket::filters($this->filter)
            ->where('key','non_npwp_tax_bracket')
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(NonNpwpTaxBracket $nonNpwpTaxBracket)
    {
        return $nonNpwpTaxBracket;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('key'))
            ->validate()
            ->save();

        return created_responses('non_npwp_tax_bracket');
    }

    public function update(Request $request, NonNpwpTaxBracket $nonNpwpTaxBracket)
    {
        $this->service
            ->setModel($nonNpwpTaxBracket)
            ->setAttributes($request->only('key'))
            ->validate()
            ->validateNonNpwpTaxBrackets()
            ->save();

        return updated_responses('non_npwp_tax_bracket');
    }

    public function destroy(NonNpwpTaxBracket $nonNpwpTaxBracket)
    {
        try {
            $nonNpwpTaxBracket->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_non_npwp_tax_bracket'));
        }

        return deleted_responses('non_npwp_tax_bracket');       
    }
}