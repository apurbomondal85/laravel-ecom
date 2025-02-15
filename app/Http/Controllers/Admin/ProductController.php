<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Library\Service\Admin\ProductService;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product_service;

    public function __construct(ProductService $product_service)
    {
        $this->product_service = $product_service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->product_service->dataTable();
        }

        return view('admin.pages.product.index');
    }

    public function create()
    {
        $categories = Category::select(['id', 'name'])
                                ->active()
                                ->orderBy('id', 'desc')
                                ->get();

        $brands = Brand::select(['id', 'name'])
                        ->active()
                        ->orderBy('id', 'desc')
                        ->get();

        return view("admin.pages.product.create", [
            "categories"=> $categories,
            "brands"=> $brands
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        abort_unless(404, $request);

        $result = $this->product_service->store($request->validated());

        if ($result) {
            return redirect()->route('admin.product.index');
        } else {
            return back()->withInput($request->all());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        abort_unless(404, $product);
        $brands = Brand::select(['id','name'])->orderBy('id', 'desc')->get();
        $categories = Category::select(['id', 'name'])->orderBy('id', 'desc')->get();

        return view('admin.pages.product.edit', [
            'product' => $product,
            'brands' => $brands,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product)
    {
        abort_unless(404, $product);

        $this->product_service->update($request->validated(), $product);

        return redirect()->route('admin.product.index');
    }

    public function changeStatus(Product $product)
    {
        abort_unless(404, $product);

        $result = $this->product_service->changeStatus($product);

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Product $product)
    {
        abort_unless($product, 404);

        // if ($product?->products()?->count()) {
        //     return redirect()->back()->with('error', "Could not deleted! This brand has products.");
        // }

        $result = $this->product_service->delete($product);

        if ($result) {
            return redirect()->route('admin.product.index', $product->id)->with('success', $this->product_service->message);
        }

        return back()->with('error', $this->product_service->message);
    }
}
