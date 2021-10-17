<?php

namespace App\Services\Tenant\Recruitment;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Recruitment\EventType;
use App\Services\Tenant\TenantService;

class EventTypeService extends TenantService
{
    public function __construct(EventType $eventType)
    {
        $this->model = $eventType;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'name' => 'required|min:2',
        ])->validate();

        return $this;
    }

    public function validateEvents(): EventTypeService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasEvent(),
            new GeneralException(__t('you_cant_update_event_type_if_the_type_already_has_event_applied'))
        );

        return $this;
    }
}
