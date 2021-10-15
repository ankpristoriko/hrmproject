<?php

namespace App\Http\Controllers\Tenant\CoreHR;

use App\Filters\Tenant\PromotionFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\CoreHR\PromotionRequest as Request;
use App\Models\Tenant\CoreHR\Promotion;
use App\Notifications\Tenant\CoreHR\PromotionNotification;
use App\Services\Tenant\CoreHR\PromotionService;

class PromotionController extends Controller
{
    /**
     * CrudController constructor.
     * @param PromotionService $service
     * @param PromotionFilter $filter
     */
    public function __construct(PromotionService $service, PromotionFilter $filter)
    {
        $this->service = $service;
        $this->filter = $filter;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->service
            ->filters($this->filter)
            ->latest('id')
            // ->with('company:id,company_name', 'employee:id,first_name,last_name')
            ->paginate(request()->get('per_page', 10));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory\Illuminate\View\View
     */
    public function view()
    {
        return view('core-hr.promotion.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $promotion = $this->service->save();

        notify()
            ->on('row_created')
            ->with($promotion)
            ->send(PromotionNotification::class);

        return created_responses('data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->service->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        $promotion = $this->service->update($promotion);

        notify()
            ->on('row_updated')
            ->with($promotion)
            ->send(PromotionNotification::class);

        return updated_responses('data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        if ($this->service->delete($promotion)) {

            notify()
                ->on('row_deleted')
                ->with((object)$promotion->toArray())
                ->send(PromotionNotification::class);

            return deleted_responses('data');
        }
        return failed_responses();
    }

    public function getEmployeeFromPromotion()
    {
        return $this->service->getEmployee();
    }
}
