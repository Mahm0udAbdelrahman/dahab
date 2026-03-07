<?php
namespace App\Services\Web;

use App\Models\Maintenance;
use App\Models\User;
use App\Notifications\DashboardNotification;
use App\Traits\HasImage;
use Illuminate\Support\Facades\Notification;

class MaintenanceService
{
    use HasImage;


    public function store($data)
    {
        $data['user_id'] = auth()->id();
        if (isset($data['image'])) {
           $data['image']  = $this->saveImage($data['image'], 'maintenance/images');
        }
      $maintenance =  Maintenance::create($data);
        $admins = User::whereHas('roles', fn($q) => $q->where('name', 'admin'))->get();

                Notification::send(
                    $admins,
                    notification: new DashboardNotification(
                        $maintenance->id,
                        $maintenance->user->name,
                        null,
                        'maintenances'
                    )
                );
            return $maintenance;
    }
}
