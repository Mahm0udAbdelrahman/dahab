<?php
namespace App\Services\Web;

use App\Models\Sale;
use App\Models\User;
use App\Notifications\DashboardNotification;
use App\Traits\HasImage;
use Illuminate\Support\Facades\Notification;

class SaleService
{
    use HasImage;

    public function store($data)
    {
        $data['user_id'] = auth()->id();
        if (isset($data['image'])) {
            $data['image'] = $this->saveImage($data['image'], 'Sale/images');
        }
        $sale   = Sale::create($data);
        $admins = User::whereHas('roles', fn($q) => $q->where('name', 'admin'))->get();

        Notification::send(
            $admins,
            new DashboardNotification(
                $sale->id,
                $sale->user->name,
                $sale->price,
                'sales'
            )
        );
        return $sale;

    }
}
