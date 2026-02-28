<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Services\Web\SaleService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Web\StoreSaleRequest;

class SaleController extends Controller
{
    public function __construct(public SaleService $saleService) {}
    public function index(Request $request)
    {
        return view('web.pages.sale');
    }


    public function store(Request $storeSaleRequest)
    {

        $data = $storeSaleRequest->all();
        $this->saleService->store($data);
        Session::flash('message', ['type' => 'success', 'text' => __('Sale created successfully')]);
        return redirect()->back();
    }


}
