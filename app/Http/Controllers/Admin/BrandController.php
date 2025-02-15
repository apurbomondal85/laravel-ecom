<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brand\StoreRequest;
use App\Http\Requests\Admin\Brand\UpdateRequest;
use App\Library\Service\Admin\BrandService;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    private $brand_service;

    public function __construct(BrandService $brand_service)
    {
        $this->brand_service = $brand_service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->brand_service->dataTable();
        }

        return view('admin.pages.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.pages.brand.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        abort_unless(404, $request);

        $result = $this->brand_service->store($request->all());

        if ($result) {
            return redirect()->route('admin.brand.index');
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
    public function edit(Brand $brand)
    {
        abort_unless(404, $brand);

        return view('admin.pages.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Brand $brand)
    {
        abort_unless(404, $brand);

        $this->brand_service->update($request->validated(), $brand);

        return redirect()->route('admin.brand.index');
    }

    public function changeStatus(Brand $brand)
    {
        abort_unless(404, $brand);

        $result = $this->brand_service->changeStatus($brand);

        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Brand $brand)
    {
        abort_unless($brand, 404);

        // if ($brand?->products()?->count()) {
        //     return redirect()->back()->with('error', "Could not deleted! This brand has products.");
        // }

        $result = $this->brand_service->delete($brand);

        if ($result) {
            return redirect()->route('admin.brand.index', $brand->id)->with('success', $this->brand_service->message);
        }

        return back()->with('error', $this->brand_service->message);
    }
}
