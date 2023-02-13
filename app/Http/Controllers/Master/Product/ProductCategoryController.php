<?php

namespace App\Http\Controllers\Master\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ DB };
use ProtoneMedia\Splade\Facades\Toast;

use App\Http\Requests\Master\Product\ProductCategory\{ StoreProductCategoryRequest, UpdateProductCategoryRequest };

// Models
use App\Models\Master\Product\ProductCategory;

// Table
use App\Tables\Master\Product\ProductCategoryTable;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productCategories = ProductCategoryTable::class;
        
        return view('master.products.categories.index', compact('productCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.products.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductCategoryRequest $request)
    {
        try {
            $form = $request->validated();
            
            $data = DB::transaction(function() use($form) {
                $category = new ProductCategory;
                $category->fill($form);

                $category->save();

                return $category;
            });

            return redirect()->route('master.products.categories.index')->with('success', __('Data has been saved successfully.'));
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

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Product\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\Product\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $category)
    {
        return view('master.products.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductCategoryRequest  $request
     * @param  \App\Models\Master\Product\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductCategoryRequest $request, ProductCategory $category)
    {
        try {
            $form = $request->validated();

            $data = DB::transaction(function() use($form, $category) {
                $category->fill($form);

                $category->save();

                return $category;
            });

            return redirect()->route('master.products.categories.index')->with('success', __('Data has been saved successfully.'));
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
    public function delete(ProductCategory $category)
    {
        try {
            return view('master.products.categories.delete', compact('category'));
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
     * @param  \App\Models\Master\Product\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $category)
    {
        try {
            $data = DB::transaction(function () use($category) {
                $category->delete();

                return $category;
            });

            return redirect()->route('master.products.categories.index')->with('success', __('Data has been deleted successfully.'));
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
