<?php

namespace App\Http\Controllers\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Master\Relationship;
use App\Filters\Tenant\Master\RelationshipFilter;
use App\Services\Tenant\Master\RelationshipService;

class RelationshipController extends Controller
{
    public function __construct(RelationshipService $service, RelationshipFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return Relationship::filters($this->filter)
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(Relationship $relationship)
    {
        return $relationship;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('name'))
            ->validate()
            ->save();

        return created_responses('relationship');
    }

    public function update(Request $request, Relationship $relationship)
    {
        $this->service
            ->setModel($relationship)
            ->setAttributes($request->only('name'))
            ->validate()
            ->validateRelationships()
            ->save();

        return updated_responses('relationship');
    }

    public function destroy(Relationship $relationship)
    {
        try {
            $relationship->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_relationship'));
        }

        return deleted_responses('relationship');       
    }
}