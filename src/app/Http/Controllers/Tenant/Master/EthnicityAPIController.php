<?php


namespace App\Http\Controllers\Tenant\Master;


use App\Http\Controllers\Controller;
use App\Models\Tenant\Master\Ethnicity;

class EthnicityAPIController extends Controller
{
    public function index()
    {
        return Ethnicity::select('id','name')->get();
    }
}