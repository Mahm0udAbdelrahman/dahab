<?php
namespace App\Services\Dashboard;

use App\Models\Maintenance;
use App\Traits\HasImage;

class MaintenanceService
{
    use HasImage;
    public function __construct(public Maintenance $model)
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
        $maintenance = $this->show($id);

        $maintenance->delete();

        return $maintenance;
    }

    public function bulkDelete($ids)
    {
        return $this->model->whereIn('id', $ids)->delete();
    }

}
