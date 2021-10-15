<?php

namespace App\Http\Controllers\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Master\DocumentType;
use App\Filters\Tenant\Master\DocumentTypeFilter;
use App\Services\Tenant\Master\DocumentTypeService;

class DocumentTypeController extends Controller
{
    public function __construct(DocumentTypeService $service, DocumentTypeFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return DocumentType::filters($this->filter)
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(DocumentType $documentType)
    {
        return $documentType;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('name'))
            ->validate()
            ->save();

        return created_responses('document_type');
    }

    public function update(Request $request, DocumentType $documentType)
    {
        $this->service
            ->setModel($documentType)
            ->setAttributes($request->only('name'))
            ->validate()
            ->validateDocuments()
            ->save();

        return updated_responses('document_type');
    }

    public function destroy(DocumentType $documentType)
    {
        try {
            $documentType->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_document_type'));
        }

        return deleted_responses('document_type');       
    }
}