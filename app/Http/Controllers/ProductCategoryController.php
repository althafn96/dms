<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{

    public function fetchForSelect(Request $request)
    {
        $product_categories = array();

        if ($request->has('search')) {
            $product_categories_in_table = ProductCategory::where('title', 'like', '%' . $request->search . '%')->get();
        } else {
            $product_categories_in_table = ProductCategory::get();
        }

        foreach ($product_categories_in_table as $category) {
            array_push($product_categories, $category);
        }

        $add_category_btn = array('title' => '➕ Add Category', 'id' => '-1');
        array_push($product_categories, $add_category_btn);

        return $product_categories;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if ($request->category_title == '') {
            return response()->json([
                'type' => 'Error',
                'text' => 'category title cant be empty'
            ]);
        }

        $category = new ProductCategory;
        $category->title = $request->category_title;
        $category->save();

        return response()->json([
            'type' => 'Success',
            'text' => 'product category added successfully'
        ]);
    }

    public function show(ProductCategory $productCategory)
    {
        //
    }

    public function edit(ProductCategory $productCategory)
    {
        //
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        //
    }

    public function destroy(ProductCategory $productCategory)
    {
        //
    }
}
