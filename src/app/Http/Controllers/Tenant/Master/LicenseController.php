<?php

namespace App\Http\Controllers\Tenant\Master;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\Master\License;
use App\Filters\Tenant\Master\LicenseFilter;
use App\Services\Tenant\Master\LicenseService;

class LicenseController extends Controller
{
    public function __construct(LicenseService $service, LicenseFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    public function index()
    {
        return License::filters($this->filter)
            ->latest()
            ->paginate(request()->get('per_page', 10));
    }
    
    public function show(License $license)
    {
        return $license;
    }

    public function store(Request $request)
    {
        $this->service
            ->setAttributes($request->only('name','description'))
            ->validate()
            ->save();

        return created_responses('license');
    }

    public function update(Request $request, License $license)
    {
        $this->service
            ->setModel($license)
            ->setAttributes($request->only('name','description'))
            ->validate()
            ->validateLicenses()
            ->save();

        return updated_responses('license');
    }

    public function destroy(License $license)
    {
        try {
            $license->delete();
        } catch (\Exception $e) {
            throw new GeneralException(__t('can_not_delete_used_license'));
        }

        return deleted_responses('license');       
    }
}