<?php

namespace App\Models\Tenant\Recruitment\JobPost\Traits\Rules;


trait JobTypeRules
{
    public function createdRules()
    {
        return [
            'name' => 'required|sometimes|string',
            'brief' => 'nullable|string',
        ];
    }

    public function updatedRules()
    {
        return [
            'name' => 'required|sometimes|string',
            'brief' => 'nullable|string',
        ];
    }
}