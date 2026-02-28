<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Dashboard\Category\{StoreCategoryRequest, UpdateCategoryRequest};
use App\Services\Dashboard\CategoryService;

class CategoryController extends Controller
{
    public function __construct(public CategoryService $categoryService) {}
    public function index(Request $request)
    {
        $categories  = $this->categoryService->index();
        return view('dashboard.pages.categories.index', compact('categories'));
    }
    public function create()
    {
        return view('dashboard.pages.categories.create');
    }

    public function store(StoreCategoryRequest $storeCategoryRequest)
    {

        $data = $storeCategoryRequest->validated();
        $this->categoryService->store($data);
        Session::flash('message', ['type' => 'success', 'text' => __('Category created successfully')]);
        return redirect()->route('Admin.categories.index');
    }

    public function show($id)
    {
        $category = $this->categoryService->show($id);
        return view('dashboard.pages.categories.show', compact('category'));
    }

    public function edit($id)
    {
         $category = $this->categoryService->show($id);

        return view('dashboard.pages.categories.edit', compact('category'));
    }

    public function update($id, UpdateCategoryRequest $updateCategoryRequest)
    {

        $data = $updateCategoryRequest->validated();
        $this->categoryService->update($id, $data);
        Session::flash('message', ['type' => 'success', 'text' => __('Category updated successfully')]);
        return redirect()->route('Admin.categories.index');
    }

    public function destroy(string $id)
    {
        $this->categoryService->destroy($id);

        return redirect()->route('Admin.categories.index')->with('success', 'Category Successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
        ]);

        $this->categoryService->bulkDelete($request->ids);

        return redirect()->back()->with('success', 'Category deleted successfully');
    }
}
