<?php

namespace App\Services\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Master\Relationship;
use App\Services\Tenant\TenantService;

class RelationshipService extends TenantService
{
    public function __construct(Relationship $relationship)
    {
        $this->model = $relationship;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'name' => 'required|min:2',
        ])->validate();

        return $this;
    }

    public function validateRelationships(): RelationshipService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasRelationship(),
            new GeneralException(__t('you_cant_update_relationship_if_the_type_already_has_relationship_applied'))
        );

        return $this;
    }
}
