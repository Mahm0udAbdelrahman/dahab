<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Services\Web\MaintenanceService;
use App\Http\Requests\Web\StoreMaintenanceRequest;

class MaintenanceController extends Controller
{
    public function __construct(public MaintenanceService $maintenanceService) {}
    public function index(Request $request)
    {
        return view('web.pages.maintenance');
    }


    public function store(StoreMaintenanceRequest $storeMaintenanceRequest)
    {

        $data = $storeMaintenanceRequest->validated();
        $this->maintenanceService->store($data);
        Session::flash('message', ['type' => 'success', 'text' => __('Maintenance created successfully')]);
        return redirect()->back();
    }


}
