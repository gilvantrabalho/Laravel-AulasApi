<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productModel;

    public function __construct(Product $product)
    {
        $this->productModel = $product;
    }

    public function index()
    {
        $products = $this->productModel->paginate(10);

        return new ProductCollection($products);
    }


    public function save(Request $request)
    {
        $data = $request->all();
        $product = $this->productModel->create($data);

        return response()->json($product);
    }

    public function show($id)
    {
        $product = $this->productModel->find($id);

        return new ProductResource($product);
        // return response()->json($product);
    }
}
