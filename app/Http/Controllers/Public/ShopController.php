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

        if (isset($data['categories']) && $data['categories'] != '') {
            $query->orWhereIn('category_id', explode(',', $data['categories']));
        }

        if (isset($data['brands']) && $data['brands'] != '') {
            $query->orWhereIn('brand_id', explode(',', $data['brands']));
        }

        if (isset($data['shortBy']) && $data['shortBy'] != '') {
            switch ($data['shortBy']) {
                case $data['shortBy'] == '1':
                    $query->orderBy('name', 'asc');
                    break;
                case $data['shortBy'] == '2':
                    $query->orderBy('name', 'desc');
                    break;
                case $data['shortBy'] == '3':
                    $query->orderBy('price', 'asc');
                    break;
                case $data['shortBy'] == '4':
                    $query->orderBy('price', 'desc');
                    break;
                case $data['shortBy'] == '5':
                    $query->orderBy('created_at', 'asc');
                    break;
                case $data['shortBy'] == '6':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                $query->orderBy('created_at', 'desc');
            }
        }

        if (isset($data['price_range'])) {
            $priceRange = explode(',', $data['price_range']);
            $query->whereBetween('price', [(float) $priceRange[0], (float) $priceRange[1]]);
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
