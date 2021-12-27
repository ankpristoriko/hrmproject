<?php

namespace App\Http\Controllers\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Master\Bank;
use App\Filters\Tenant\Master\BankFilter;
use App\Services\Tenant\Master\BankService;

class BankController extends Controller
{
    public function __construct(BankService $service, BankFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return Bank::filters($this->filter)
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(Bank $bank)
    {
        return $bank;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('name'))
            ->validate()
            ->save();

        return created_responses('bank');
    }

    public function update(Request $request, Bank $bank)
    {
        $this->service
            ->setModel($bank)
            ->setAttributes($request->only('name'))
            ->validate()
            ->validateBanks()
            ->save();

        return updated_responses('bank');
    }

    public function destroy(Bank $bank)
    {
        try {
            $bank->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_bank'));
        }

        return deleted_responses('bank');       
    }
}