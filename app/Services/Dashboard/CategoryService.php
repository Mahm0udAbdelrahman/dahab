<?php
namespace App\Services\Dashboard;

use App\Models\Category;
use App\Traits\HasImage;

class CategoryService
{
    use HasImage;
    public function __construct(public Category $model)
    {}

    public function index()
    {

        return $this->model->latest()->paginate(10);
    }

    public function store($data)
    {

        return $this->model->create($data);

    }

    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($id, $data)
    {
        $category = $this->show($id);

        $category->update($data);

        return $category;
    }

    public function destroy($id)
    {
        $category = $this->show($id);

        $category->delete();

        return $category;
    }

    public function bulkDelete($ids)
    {
        return $this->model->whereIn('id', $ids)->delete();
    }

}
