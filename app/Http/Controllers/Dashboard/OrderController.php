<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Order\UpdateOrderRequest;
use App\Http\Requests\Dashboard\Product\{StoreProductRequest, UpdateProductRequest};
use App\Services\Dashboard\OrderService;
use App\Services\Dashboard\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function __construct(public OrderService $orderService) {}
    public function index(Request $request)
    {
        $orders  = $this->orderService->index();
        return view('dashboard.pages.orders.index', compact('orders'));
    }




    public function show($id)
    {
        $order = $this->orderService->show($id);
        return view('dashboard.pages.orders.show', compact('order'));
    }

    public function edit($id)
    {
         $order = $this->orderService->show($id);
        return view('dashboard.pages.orders.edit', compact('order'));
    }

    public function update($id, UpdateOrderRequest $updateOrderRequest)
    {

        $data = $updateOrderRequest->validated();
        $this->orderService->update($id, $data);
        Session::flash('message', ['type' => 'success', 'text' => __('Order updated successfully')]);
        return redirect()->route('Admin.orders.index');
    }

    public function destroy(string $id)
    {
        $this->orderService->destroy($id);

        return redirect()->route('Admin.orders.index')->with('success', 'Order Successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
        ]);

        $this->orderService->bulkDelete($request->ids);

        return redirect()->back()->with('success', 'Order deleted successfully');
    }
}
