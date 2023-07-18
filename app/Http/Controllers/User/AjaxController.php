<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return pizza list
    public function pizzaList(Request $request)
    {
        //logger($request->status);
        if ($request->status == 'desc') {
            $data = Product::orderBy('created_at', 'desc')->get();
        } else {
            $data = Product::orderBy('created_at', 'asc')->get();
        }

        return response()->json($data, 200); //200 is a http  status page
    }
    // add to cart return to pizza list
    public function addCart(Request $request)
    {
        //logger($request->all());
        $data = $this->getOrderData($request);
        Cart::create($data);
        $response  = [
            'status' => 'success',
            'message' => 'add order successfully'
        ];
        return response()->json($response, 200);
    }
    // order
    public function order(Request $request)
    {
        // logger($request->all());
        $total = 0;
        foreach ($request->all() as $item) {
            $data = OrderList::create([
                'user_id' => $item['userId'],
                'product_id' => $item['productId'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['orderCode'],
            ]);
            $total += $data->total;
            //$total += $total;
        }
        // logger('success');
        Cart::where('user_id', Auth::user()->id)->delete();
        Order::create([
            'user_id' => $data->user_id,
            'order_code' => $data->order_code,
            'total_price' => $total + 3000
        ]);
        return response()->json([
            'status' => 'true',
            'message' => 'order success'
        ], 200);
    }
    // clear cart
    public function clearCart()
    {
        Cart::where('user_id', Auth::user()->id)->delete();
    }
    //clear current product
    public function clearCurrProduct(Request $request)
    {
        Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $request->productId)
            ->where('id', $request->orderId)
            ->delete();
    }

    // increase view count
    public function viewsCount(Request $request)
    {
        $view = ['view_count' => $request->viewCount];
        Product::where('id', $request->productId)->update($view);
    }

    //get order data function
    private function getOrderData($request)
    {
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->orderCount,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
