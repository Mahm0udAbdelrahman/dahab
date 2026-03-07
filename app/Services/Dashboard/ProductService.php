<?php
namespace App\Services\Dashboard;

use App\Models\Product;
use App\Models\Category;
use App\Traits\HasImage;

class ProductService
{
    use HasImage;
    public function __construct(public Product $model)
    {}

    public function index()
    {

        return $this->model->latest()->paginate(10);
    }

    public function getCategories()
    {
        return Category::active()->get();
    }

    public function store($data)
    {
        $product = $this->model->create($data);

        if(isset($data['images'])){
            foreach ($data['images'] as $image) {
                $product->images()->create([
                    'image' => $this->saveImage($image, 'products'),
                ]);
            }
        }
        return $product;
    }

    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($id, $data)
    {
        $product = $this->show($id);

        if(isset($data['images'])){
            foreach ($product->images as $image) {
                $this->deleteImage($image->image);
                $image->delete();
            }
            foreach ($data['images'] as $image) {
                $product->images()->create([
                    'image' => $this->saveImage($image, 'products'),
                ]);
            }
        }

        $product->update($data);

        return $product;
    }

    public function destroy($id)
    {
        $product = $this->show($id);

        foreach ($product->images as $image) {
            $this->deleteImage($image->image);
            $image->delete();
        }
        $product->delete();

        return $product;
    }

    public function deleteProductImage($imageId)
    {
        $image = \App\Models\ProductImage::findOrFail($imageId);
        $this->deleteImage($image->image);
        return $image->delete();
    }
    public function bulkDelete($ids)
    {
        return $this->model->whereIn('id', $ids)->delete();
    }

}
