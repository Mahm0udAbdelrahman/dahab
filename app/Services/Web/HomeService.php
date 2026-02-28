<?php
namespace App\Services\Web;

use App\Models\Product;
use App\Models\Category;

class HomeService
{
    public function __construct(public Product $model){}

    public function index(?string $query, ?int $categoryId)
    {
        

        $products = $this->model->active();

        if ($categoryId && $categoryId != 0) {
            $products->where('category_id', $categoryId);
        }

        if ($query) {
            $products->where(
                'name->' . app()->getLocale(),
                'LIKE',
                '%' . $query . '%'
            );
        }

        return $products->get();
    }


}

