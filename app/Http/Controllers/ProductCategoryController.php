<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use DataTables;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $productCategoires = ProductCategory::orderBy('name')->get();

            return Datatables::of($productCategoires)
                    ->addIndexColumn()
                    ->addColumn('action', function($productCategory){
                        $edit = view('components.button-action', [
                                        'get' => route('product-categories.edit', $productCategory->id),
                                        'patch' => route('product-categories.update', $productCategory->id),
                                        'target' => '#edit-product-category',
                                        'label' => 'edit'
                                    ]);
                        $delete = view('components.button-action', [
                                        'action' => route('product-categories.destroy', $productCategory->id),
                                        'target' => '#delete-confirmation',
                                        'label' => 'delete'
                                    ]);

                        return $edit . $delete;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('pages.product.product-category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCategoryRequest $request)
    {
        $productCategory = new ProductCategory($request->validated());

        $productCategory->save();

        return response()->json(['data' => ['message' => 'Data berhasil disimpan!']]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory)
    {
        return response()->json([
                'data' => [
                    'name' => $productCategory->name
                ]
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $productCategory->update($request->validated());
        return response()->json(['data' => ['message' => 'Data berhasil disimpan!']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();

        return response()->json(['data' => ['message' => 'Data berhasil dihapus!']]);
    }
}
