<?php

namespace App\Http\Controllers;

use App\User;
use DataTables;
use App\Product;

use App\StockInHand;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StockInHandController extends Controller
{
    public function index(Request $request, Product $product)
    {
        $title = array(
            'menu' => 'Products',
            'page' => 'Stock In Hand | ' . ucfirst($product->title)
        );

        if ($request->ajax()) {
            $stock = Product::find($product->id)->stock;

            return DataTables::of($stock)
                ->addColumn('added_on', function ($stock) {
                    return $stock->created_at;
                })
                ->addColumn('added_by', function ($stock) {
                    $user = User::find($stock->added_user_id);
                    return $user->fname . ' ' . $user->lname;
                })
                // ->rawColumns(['action'])
                ->make('true');
        }

        return view('stock-in-hand.index', compact('title', 'product'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if ($request->stock_qty == '') {
            return response()->json([
                'type' => 'Error',
                'text' => 'stock qty cant be empty'
            ]);
        }

        if ($request->product_id == '') {
            return response()->json([
                'type' => 'Error',
                'text' => 'unkonwn error occurred. please try again later'
            ]);
        }

        $stock = new StockInHand;
        $stock->product_id = $request->product_id;
        $stock->stock_qty = $request->stock_qty;
        $stock->added_user_id = auth()->user()->id;
        $stock->created_at = Carbon::now()->setTimezone('Asia/Colombo');

        $product = Product::find($request->product_id);
        $product->is_available = '1';

        if ($stock->save()) {
            $product->save();
            return response()->json([
                'type' => 'Success',
                'text' => 'stock added successfully'
            ]);
        } else {
            return response()->json([
                'type' => 'Error',
                'text' => 'unkonwn error occurred. please try again later'
            ]);
        }
    }

    public function show(StockInHand $stockInHand)
    {
        //
    }

    public function edit(StockInHand $stockInHand)
    {
        //
    }

    public function update(Request $request, StockInHand $stockInHand)
    {
        //
    }

    public function destroy(StockInHand $stockInHand)
    {
        //
    }
}
