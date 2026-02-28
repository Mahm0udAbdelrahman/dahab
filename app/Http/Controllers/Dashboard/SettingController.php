<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Dashboard\Setting\StoreSettingRequest;
use App\Services\Dashboard\SettingService;

class SettingController extends Controller
{
    public function __construct(public SettingService $settingService) {}
    public function index(Request $request)
    {
        $setting  = $this->settingService->setting();
        return view('dashboard.pages.settings.edit', compact('setting'));
    }


    public function store(StoreSettingRequest $storeSettingRequest)
    {

        $data = $storeSettingRequest->validated();
        $this->settingService->update($data);
        Session::flash('message', ['type' => 'success', 'text' => __('Setting created successfully')]);
        return redirect()->back();
    }


}
