<?php

namespace App\Http\Controllers\Master\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ DB };
use ProtoneMedia\Splade\Facades\Toast;
use DNS1D;

// Models
use App\Models\Master\Product\{ Product, ProductCategory };

// Requests
use App\Http\Requests\Master\Product\{ StoreProductRequest, UpdateProductRequest };

// Table
use App\Tables\Master\Product\ProductTable;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductTable::class;

        return view('master.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::select(['id', 'name'])->get();

        return view('master.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $form = $request->validated();

            $data = DB::transaction(function () use($form) {
                $product = new Product;
                $product->fill($form);
                
                if (isset($form['category_id'])) {
                    $product->category()->associate(ProductCategory::findOrFail($form['category_id']));
                }

                $product->save();

                return $product;
            });

            return redirect()->route('master.products.index')->with('success', __('Data has been saved successfully.'));
        } catch (\Exception $e) {
            switch (get_class($e)) {
                case \Illuminate\Database\Eloquent\ModelNotFoundException::class:
                    $message = __("Data not found");
                    $title = "Whoops!";
                    break;
                default:
                    $message = $e->getMessage();
                    $title = "Whoops!";
                    break;
            }

            Toast::title($title)
                ->message($message)
                ->danger()
                ->center()
                ->backdrop();

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $barcodePNGPath = $product->barcode ? DNS1D::getBarcodePNG($product->barcode, 'C128', 3, 33, [1,1,1]) : false;

        return view('master.products.show', compact('product', 'barcodePNGPath'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::select(['id', 'name'])->get();

        return view('master.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $form = $request->validated();

            $data = DB::transaction(function() use($form, $product) {
                $product->fill($form);
                
                if (!isset($form['category_id'])) {
                    $product->category()->dissociate();
                } else {
                    $product->category()->associate(ProductCategory::findOrFail($form['category_id']));
                }

                $product->save();

                return $product;
            });

            return redirect()->route('master.products.index')->with('success', __('Data has been saved successfully.'));
        } catch(\Exception $e) {
            switch (get_class($e)) {
                case \Illuminate\Database\Eloquent\ModelNotFoundException::class:
                    $message = __("Data not found");
                    $title = "Whoops!";
                    break;
                default:
                    $message = $e->getMessage();
                    $title = "Whoops!";
                    break;
            }

            Toast::title($title)
                ->message($message)
                ->danger()
                ->center()
                ->backdrop();

            return back();
        }
    }

    /**
     * Show the modal for deleting the specified resource.
     *
     * @param  \App\Models\Master\Member\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function delete(Product $product)
    {
        try {
            return view('master.products.delete', compact('product'));
        } catch (\Exception $e) {
            switch (get_class($e)) {
                case \Illuminate\Database\Eloquent\ModelNotFoundException::class:
                    $message = __("Data not found");
                    $title = "Whoops!";
                    break;
                default:
                    $message = $e->getMessage();
                    $title = "Whoops!";
                    break;
            }

            Toast::title($title)
                ->message($message)
                ->danger()
                ->center()
                ->backdrop();

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $data = DB::transaction(function () use($product) {
                $product->delete();

                return $product;
            });

            return redirect()->route('master.products.index')->with('success', __('Data has been deleted successfully.'));
        } catch (\Exception $e) {
            switch (get_class($e)) {
                case \Illuminate\Database\Eloquent\ModelNotFoundException::class:
                    $message = __("Data not found");
                    $title = "Whoops!";
                    break;
                default:
                    $message = $e->getMessage();
                    $title = "Whoops!";
                    break;
            }

            Toast::title($title)
                ->message($message)
                ->danger()
                ->center()
                ->backdrop();

            return redirect()->back();
        }
    }
}
