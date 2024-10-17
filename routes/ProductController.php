<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService; // Asegúrate de que el namespace del servicio sea correcto

class ProductController extends Controller
{
    protected $productService;

    // Constructor que inyecta la dependencia ProductService
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        // Llamada al servicio para obtener todos los productos
        $products = $this->productService->getAllProducts();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Utilizando el servicio para crear el producto
        $this->productService->createProduct($validatedData);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Utilizando el servicio para actualizar el producto
        $this->productService->updateProduct($product, $validatedData);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Utilizando el servicio para eliminar el producto
        $this->productService->deleteProduct($product);
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
