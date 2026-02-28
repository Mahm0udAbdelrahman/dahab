<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Dashboard\Product\{StoreProductRequest, UpdateProductRequest};
use App\Services\Dashboard\ProductService;

class ProductController extends Controller
{
    public function __construct(public ProductService $productService) {}
    public function index(Request $request)
    {
        $products  = $this->productService->index();
        return view('dashboard.pages.products.index', compact('products'));
    }
    public function create()
    {
        $categories = $this->productService->getCategories();
        return view('dashboard.pages.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $storeProductRequest)
    {

        $data = $storeProductRequest->validated();
        $this->productService->store($data);
        Session::flash('message', ['type' => 'success', 'text' => __('Product created successfully')]);
        return redirect()->route('Admin.products.index');
    }

    public function show($id)
    {
        $product = $this->productService->show($id);
        return view('dashboard.pages.products.show', compact('product'));
    }

    public function edit($id)
    {
         $product = $this->productService->show($id);
        $categories = $this->productService->getCategories();
        return view('dashboard.pages.products.edit', compact('product', 'categories'));
    }

    public function update($id, UpdateProductRequest $updateProductRequest)
    {

        $data = $updateProductRequest->validated();
        $this->productService->update($id, $data);
        Session::flash('message', ['type' => 'success', 'text' => __('Product updated successfully')]);
        return redirect()->route('Admin.products.index');
    }

    public function destroy(string $id)
    {
        $this->productService->destroy($id);

        return redirect()->route('Admin.products.index')->with('success', 'Product Successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
        ]);

        $this->productService->bulkDelete($request->ids);

        return redirect()->back()->with('success', 'Product deleted successfully');
    }
}
