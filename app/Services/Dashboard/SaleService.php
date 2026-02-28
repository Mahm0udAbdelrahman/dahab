<?php
namespace App\Services\Dashboard;

use App\Models\Sale;
use App\Traits\HasImage;

class SaleService
{
    use HasImage;
    public function __construct(public Sale $model)
    {}

    public function index()
    {

        return $this->model->latest()->paginate(10);
    }


    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

 

    public function destroy($id)
    {
        $sale = $this->show($id);

        $sale->delete();

        return $sale;
    }

    public function bulkDelete($ids)
    {
        return $this->model->whereIn('id', $ids)->delete();
    }

}
