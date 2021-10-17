<?php

namespace App\Http\Controllers\Tenant\Recruitment;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Recruitment\EventType;
use App\Filters\Tenant\Recruitment\EventTypeFilter;
use App\Services\Tenant\Recruitment\EventTypeService;

class EventTypeController extends Controller
{
    public function __construct(EventTypeService $service, EventTypeFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return EventType::filters($this->filter)
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(EventType $eventType)
    {
        return $eventType;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('name'))
            ->validate()
            ->save();

        return created_responses('event_type');
    }

    public function update(Request $request, EventType $eventType)
    {
        $this->service
            ->setModel($eventType)
            ->setAttributes($request->only('name','brief'))
            ->validate()
            ->validateEvents()
            ->save();

        return updated_responses('event_type');
    }

    public function destroy(EventType $eventType)
    {
        try {
            $eventType->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_event_type'));
        }

        return deleted_responses('event_type');       
    }
}