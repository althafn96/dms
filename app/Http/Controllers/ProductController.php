<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use DataTables;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $title = array(
            'menu' => 'Products',
            'page' => 'Products'
        );

        if ($request->ajax()) {
            $products = DB::table('products')
                // ->join('product_categories', 'product_categories.id', '=', 'products.product_category_id')
                ->join('suppliers', 'suppliers.id', '=', 'products.supplier_id')
                ->join('users', 'users.id', '=', 'suppliers.user_id')
                ->select(
                    'products.*',
                    // 'product_categories.title as category', 
                    'users.fname',
                    'users.lname'
                )
                ->where('products.is_deleted', '0')
                ->get();

            return DataTables::of($products)
                ->addColumn('category', function ($product) {
                    $category = ProductCategory::find($product->product_category_id);
                    return $category->title;
                })
                ->addColumn('supplier', function ($product) {
                    return $product->fname . ' ' . $product->lname;
                })
                ->addColumn('action', function ($product) {
                    return '';
                })
                ->rawColumns(['action'])
                ->make('true');
        }

        return view('products.index', compact('title'));
    }

    public function create()
    {
        $title = array(
            'menu' => 'Products',
            'page' => 'Create Product'
        );

        return view('products.create', compact('title'));
    }

    public function store(Request $request)
    {
        $product = new Product;

        $product->title               = $request->title;
        $product->product_category_id = $request->category;
        $product->supplier_id         = $request->supplier;

        if ($product->save()) {
            return response()->json([
                'type' => 'Success',
                'text' => 'product added successfully'
            ]);
        } else {
            return response()->json([
                'type' => 'Error',
                'text' => 'product not added. try again later or contact management'
            ]);
        }
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        $product = Product::find($product->id);
        $supplier = DB::table('suppliers')->join('users', 'users.id', '=', 'suppliers.user_id')->where('suppliers.id', $product->supplier_id)->select('users.fname')->first();
        $category = DB::table('product_categories')->where('id', $product->product_category_id)->select('title')->first();
        $title = array(
            'menu' => 'Products',
            'page' => 'Edit Product'
        );

        return view('products.edit', compact('title', 'product', 'supplier', 'category'));
    }

    public function update(Request $request, Product $product)
    {
        $product = Product::find($product->id);

        $product->title               = $request->title;
        $product->product_category_id = $request->category;
        $product->supplier_id         = $request->supplier;

        if ($product->save()) {
            return response()->json([
                'type' => 'Success',
                'text' => 'product updated successfully'
            ]);
        } else {
            return response()->json([
                'type' => 'Error',
                'text' => 'product not added. try again later or contact management'
            ]);
        }
    }

    public function destroy(Product $product)
    {
        $product = Product::find($product->id);

        $product->is_deleted = '1';

        if ($product->save()) {
            return response()->json([
                'type' => 'Success',
                'text' => 'product removed successfully'
            ]);
        } else {
            return response()->json([
                'type' => 'Error',
                'text' => 'product not removed. try again later or contact management'
            ]);
        }
    }


    public function changeStatus(Request $request)
    {
        $product = Product::where('id', $request->id)->first();

        $product->status = $request->changeTo;

        $product->save();

        if ($product->status == '1') {
            $class = 'kt-badge--success';
            $title = 'Enabled';
            $action = 'Disable';
            $change = '0';
        } else {
            $class = 'kt-badge--danger';
            $title = 'Disabled';
            $action = 'Enable';
            $change = '1';
        }

        return response()->json([
            'type' => 'Success',
            'text' => 'status changed successfully',
            'class' => $class,
            'title' => $title,
            'action' => $action,
            'change' => $change
        ]);
    }
}
