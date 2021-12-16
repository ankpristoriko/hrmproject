<?php


namespace App\Http\Controllers\Tenant\Master;


use App\Http\Controllers\Controller;
use App\Models\Tenant\Master\EducationalInstitution;

class EducationalInstitutionAPIController extends Controller
{
    public function index()
    {
        return EducationalInstitution::select('id','name','address')->get();
    }
}