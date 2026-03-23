<?php
namespace App\Services\Dashboard;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Traits\HasImage;

class OrderService
{
    use HasImage;
    public function __construct(public Order $model)
    {}

    public function index()
    {

        return $this->model->latest()->paginate(10);
    }



    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($id, $data)
    {
        $order = $this->show($id);

        $order->update($data);

        return $order;
    }

    public function destroy($id)
    {
        $product = $this->show($id);
        $product->delete();

        return $product;
    }

    public function bulkDelete($ids)
    {
        return $this->model->whereIn('id', $ids)->delete();
    }

}
