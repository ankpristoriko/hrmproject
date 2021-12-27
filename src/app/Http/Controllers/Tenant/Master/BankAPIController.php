<?php


namespace App\Http\Controllers\Tenant\Master;


use App\Http\Controllers\Controller;
use App\Models\Tenant\Master\Bank;

class BankAPIController extends Controller
{
    public function index()
    {
        return Bank::select('id','name')->get();
    }
}