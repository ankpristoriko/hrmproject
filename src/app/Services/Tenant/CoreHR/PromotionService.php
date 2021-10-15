<?php

namespace App\Services\Tenant\CoreHR;
use App\Services\Core\BaseService;
use App\Models\Tenant\CoreHR\Promotion;
use Illuminate\Support\Facades\DB;

class PromotionService extends BaseService
{
    public function __construct(Promotion $promotion)
    {
        $this->model = $promotion;
    }

    /**
     * Get only name from Promotion model
     * @return \Illuminate\Support\Collection
     */
    public function getEmployee()
    {
        return $this->model
                ->select(DB::raw('employee_id, CONCAT(employees.first_name, " ", employees.last_name) employee_name'))
                ->leftJoin('employees', 'employees.id', '=', 'promotions.employee_id')
                ->get();
    }

    /**
     * Update Promotion service
     * @param Promotion $promotion
     * @return Promotion
     */
    public function update(Promotion $promotion)
    {
        $promotion->fill(request()->all());

        $this->model = $promotion;

        $promotion->save();

        return $promotion;
    }

    /**
     * Delete Promotion service
     * @param Promotion $promotion
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Promotion $promotion)
    {
        return $promotion->delete();
    }
}
