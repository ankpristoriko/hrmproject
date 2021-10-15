<?php

namespace App\Models\Tenant\Traits\CoreHR;

trait PromotionValidationRules
{
    public function createdRules()
    {
        return [
            'promotion_title' => 'required',
        ];
    }

    public function updatedRules()
    {
        return [
            'promotion_title' => 'required',
        ];
    }
}