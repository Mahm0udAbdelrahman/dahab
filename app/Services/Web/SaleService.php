<?php
namespace App\Services\Web;

use App\Traits\HasImage;
use App\Models\Sale;

class SaleService
{
    use HasImage;


    public function store($data)
    {
        $data['user_id'] = auth()->id();
        if (isset($data['image'])) {
           $data['image']  = $this->saveImage($data['image'], 'Sale/images');
        }
        return Sale::create($data);
    }
}
