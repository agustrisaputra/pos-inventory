<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::with('productCategory')
                                ->orderBy('name')
                                ->get();

            return Datatables::of($products)
                    ->editColumn('price', function($product) {
                        return rupiah($product->price);
                    })
                    ->editColumn('reseller_price', function($product) {
                        return rupiah($product->reseller_price);
                    })
                    ->editColumn('store_price', function($product) {
                        return rupiah($product->store_price);
                    })
                    ->editColumn('price', function($product) {
                        return rupiah($product->price);
                    })
                    ->addColumn('action', function($product){
                        $edit = view('components.button-action', [
                                        'get' => route('products.edit', $product->id),
                                        'patch' => route('products.update', $product->id),
                                        'target' => '#edit-product',
                                        'label' => 'edit'
                                    ]);
                        $delete = view('components.button-action', [
                                        'action' => route('products.destroy', $product->id),
                                        'target' => '#delete-confirmation',
                                        'label' => 'delete'
                                    ]);

                        return $edit . $delete;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('pages.product.product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();

        try {
            $productCategory = $this->getOrCreateCategory($request);

            $product = new Product($request->validated());

            $productCategory->products()->save($product);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        return response()->json(['data' => ['message' => 'Data berhasil disimpan!']]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product->load('productCategory');

        return response()->json([
            'data' => [
                'code' => $product->code,
                'name' => $product->name,
                'category' => [
                    'id' => $product->productCategory->id,
                    'text' => $product->productCategory->name
                ],
                'store_price' => $product->store_price,
                'price' => $product->price,
                'reseller_price' => $product->reseller_price,
                'stock' => $product->stock,
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
    public function update(ProductRequest $request, Product $product)
    {
        DB::beginTransaction();

        try {
            $productCategory = $this->getOrCreateCategory($request);

            $product = $product->fill($request->validated());
            $product->product_category_id = $productCategory->id;

            $product->update();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        return response()->json(['data' => ['message' => 'Data berhasil disimpan!']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['data' => ['message' => 'Data berhasil dihapus!']]);
    }

    public function getCategory(Request $request)
    {
        $categories = ProductCategory::where('name', 'like', "%$request->search%")
                            ->get()
                            ->map(fn($category) => [
                                'id' => $category->id,
                                'text' => $category->name
                            ])
                            ->toArray();

        return response()->json([
                        'data' => $categories
                    ]);
    }

    private function getOrCreateCategory(Request $request)
    {
        $category = ProductCategory::find($request->category);

        if (!isset($category)) {
            $category = new ProductCategory([
                'name' => $request->category
            ]);

            $category->save();
        }

        return $category;
    }
}
