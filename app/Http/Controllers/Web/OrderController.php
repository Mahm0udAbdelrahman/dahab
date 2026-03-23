<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Services\Web\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\OrderRequest;

class OrderController extends Controller
{
    public function __construct(public OrderService $orderService)
    {}

    public function store(OrderRequest $orderRequest)
    {
        return $this->orderService->cashOrder($orderRequest->validated());
    }

}
