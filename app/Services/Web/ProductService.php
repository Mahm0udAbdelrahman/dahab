<?php
namespace App\Services\Web;

use App\Models\Category;
use App\Models\Product;

class ProductService
{
    public function __construct(public Product $model)
    {}

    public function index()
    {
        $query = $this->model->active()->with(['category', 'images']);

        if (request()->has('categories')) {
            $query->whereIn('category_id', request('categories'));
        }

        if (request()->filled('min_price')) {
            $query->where('price', '>=', request('min_price'));
        }
        if (request()->filled('max_price')) {
            $query->where('price', '<=', request('max_price'));
        }

        $products   = $query->paginate(9)->withQueryString();
        $categories = Category::withCount('products')->get();

        return compact('products', 'categories');
    }

}
