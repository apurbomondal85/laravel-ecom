<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Library\Service\Admin\CategoryService;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category_service;

    public function __construct(CategoryService $category_service)
    {
        $this->category_service = $category_service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->category_service->dataTable();
        }

        return view('admin.pages.category.index');
    }

    public function create()
    {
        return view("admin.pages.category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        abort_unless(404, $request);

        $result = $this->category_service->store($request->all());

        if ($result) {
            return redirect()->route('admin.category.index');
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
    public function edit(Category $category)
    {
        abort_unless(404, $category);

        return view('admin.pages.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Category $category)
    {
        abort_unless(404, $category);

        $this->category_service->update($request->validated(), $category);

        return redirect()->route('admin.category.index');
    }

    public function changeStatus(Category $category)
    {
        abort_unless(404, $category);

        $result = $this->category_service->changeStatus($category);

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Category $category)
    {
        abort_unless($category, 404);

        if ($category?->products()?->count()) {
            return redirect()->back()->with('error', "Could not deleted! This brand has products.");
        }

        $result = $this->category_service->delete($category);

        if ($result) {
            return redirect()->route('admin.category.index', $category->id)->with('success', $this->category_service->message);
        }

        return back()->with('error', $this->category_service->message);
    }
}
