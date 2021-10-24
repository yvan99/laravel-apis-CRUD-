<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function showProducts()
    {
        return Product::all();
    }
    function createProducts(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'price' => 'required'
        ]);
        return Product::create($request->all());
    }
    function getSingle($id)
    {
        return Product::find($id);
    }
    function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return $product;
    }
    function deleteProduct($id)
    {
        $response = Product::destroy($id);
        if ($response) {
            return "Product deleted";
        }
        else {
            return 'Error occured';
        }
    }
}
