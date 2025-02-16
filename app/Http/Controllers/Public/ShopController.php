<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        $query = Product::with(['category', 'brand']);

        if (isset($data['category']) && $data['category'] != '') {
            $query->whereHas('category', function($query) use ($data) {
                $query->where('slug', $data['category']);
            });
        }

        if (isset($data['brand']) && $data['brand'] != '') {
            $query->where('brand_id', $data['brand']);
        }

        $products = $query->paginate(12);
        $categories = Category::active()->orderBy('name')->get();
        $brands = Brand::active()->orderBy('name')->get();

        return view('public.pages.shop.index', [
            'products'    => $products,
            'categories'  => $categories,
            'brands'=> $brands
        ]);
    }

    public function details(string $slug)
    {
        $product = Product::with(['category', 'brand'])
                            ->where('slug', $slug)
                            ->first();
        $products = Product::latest()->get();

        return view('public.pages.shop.product_details', [
            'product' => $product,
            'products'=> $products
        ]);
    }
}
