<?php
namespace App\Services\Web;

use App\Traits\HasImage;
use App\Models\Maintenance;

class MaintenanceService
{
    use HasImage;
    

    public function store($data)
    {
        $data['user_id'] = auth()->id();
        if (isset($data['image'])) {
           $data['image']  = $this->saveImage($data['image'], 'maintenance/images');
        }
        return Maintenance::create($data);
    }
}
