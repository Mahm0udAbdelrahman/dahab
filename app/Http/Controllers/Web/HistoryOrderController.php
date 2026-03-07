<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\OrderRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Services\Web\HistoryOrderService;
use Illuminate\Http\Request;

class HistoryOrderController extends Controller
{
    public function __construct(public HistoryOrderService $orderService)
    {}

    public function index()
    {
        $orders =  $this->orderService->index();
         return view('web.pages.history_order', compact('orders'));
    }



}
