<?php


namespace App\Http\Controllers\Tenant\Master;


use App\Http\Controllers\Controller;
use App\Models\Tenant\Master\EducationLevel;

class EducationAPIController extends Controller
{
    public function index()
    {
        return EducationLevel::select('id','name')->get();
    }
}