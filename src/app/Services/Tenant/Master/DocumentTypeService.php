<?php

namespace App\Services\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Models\Tenant\Master\DocumentType;
use App\Services\Tenant\TenantService;

class DocumentTypeService extends TenantService
{
    public function __construct(DocumentType $documentType)
    {
        $this->model = $documentType;
    }

    public function validate()
    {
        validator($this->getAttributes(), [
            'name' => 'required|min:2',
        ])->validate();

        return $this;
    }

    public function validateDocuments(): DocumentTypeService
    {
        $this->model->fill($this->getAttributes());

        throw_if(
            $this->model->isDirty('type') && $this->model->hasDocument(),
            new GeneralException(__t('you_cant_update_document_type_if_the_type_already_has_document_applied'))
        );

        return $this;
    }
}
