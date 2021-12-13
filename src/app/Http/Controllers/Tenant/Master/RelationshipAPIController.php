<?php


namespace App\Http\Controllers\Tenant\Master;


use App\Http\Controllers\Controller;
use App\Models\Tenant\Master\Relationship;

class RelationshipAPIController extends Controller
{
    public function index()
    {
        return Relationship::select('id','name')->get();
    }
}