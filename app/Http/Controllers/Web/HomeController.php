<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Web\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(public HomeService $homeService)
    {}

    public function index(Request $request)
    {
        $categories = Category::active()->get();
        $products   = $this->homeService->index(
            $request->query('query'),
            $request->query('category_id')
        );

        return view('web.pages.home', compact('categories', 'products'));
    }

    public function detail($id)
    {
        $product = $this->homeService->model->findOrFail($id);
        $relatedProducts = $this->homeService->model->active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->get();
        return view('web.pages.product-detail', compact('product', 'relatedProducts'));
    }

}
