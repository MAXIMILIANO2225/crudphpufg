<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function getAllProducts()
    {
        return Product::all();
    }

    public function createProduct(array $data)
    {
        Product::create($data);
    }

    public function updateProduct(Product $product, array $data)
    {
        $product->update($data);
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
    }
}
