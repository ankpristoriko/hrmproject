<?php


namespace App\Http\Controllers\Tenant\Master;


use App\Http\Controllers\Controller;
use App\Models\Tenant\Master\License;

class LicenseAPIController extends Controller
{
    public function index()
    {
        return License::select('id','name','description')->get();
    }
}