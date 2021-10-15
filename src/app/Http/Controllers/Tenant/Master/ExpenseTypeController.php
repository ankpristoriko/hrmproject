<?php

namespace App\Http\Controllers\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Master\ExpenseType;
use App\Filters\Tenant\Master\ExpenseTypeFilter;
use App\Services\Tenant\Master\ExpenseTypeService;

class ExpenseTypeController extends Controller
{
    public function __construct(ExpenseTypeService $service, ExpenseTypeFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return ExpenseType::filters($this->filter)
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(ExpenseType $expenseType)
    {
        return $expenseType;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('name'))
            ->validate()
            ->save();

        return created_responses('expense_type');
    }

    public function update(Request $request, ExpenseType $expenseType)
    {
        $this->service
            ->setModel($expenseType)
            ->setAttributes($request->only('name'))
            ->validate()
            ->validateExpenses()
            ->save();

        return updated_responses('expense_type');
    }

    public function destroy(ExpenseType $expenseType)
    {
        try {
            $expenseType->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_expense_type'));
        }

        return deleted_responses('expense_type');       
    }
}