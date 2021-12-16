<?php


namespace App\Http\Controllers\Tenant\Master;


use App\Http\Controllers\Controller;
use App\Models\Tenant\Master\Religion;

class ReligionAPIController extends Controller
{
    public function index()
    {
        return Religion::select('id','name')->get();
    }
}