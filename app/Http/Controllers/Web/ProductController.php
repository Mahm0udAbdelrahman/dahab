<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Web\ProductService;

class ProductController extends Controller
{
    public function __construct(public ProductService $productService)
    {}

    public function index()
    {
        $data = $this->productService->index();
        return view('web.pages.products', $data);
    }

}
