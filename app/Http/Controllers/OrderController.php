<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //order list direct page
    public function orderList(){
        $order = Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','users.id','orders.user_id')
                ->orderBy('created_at','desc')
                ->get();
       // dd($order->toArray());
        return view('admin.order.list',compact('order'));
    }

    // order status sort with Ajax
    public function orderStatus(Request $request){
        //dd($request->all());
        //logger($request->status);
        $order = Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','users.id','orders.user_id')
                ->orderBy('created_at','desc');
                if($request->orderStatus == null){
                    $order = $order->get();
                }else{
                    $order = $order->where('orders.status',$request->orderStatus)->get();
                }
        //dd($order);
        // return response()->json($order, 200);
        return view('admin.order.list',compact('order'));
    }

    //change status order
    public function changeStatus(Request $request){
        //logger($request->all());
        Order::where('order_code', $request->orderCode)->update(['status' => $request->status]);
    }

    //order info list
    public function orderInfo($roderCode){
        //dd($roderCode);
        $orderList = OrderList::select('order_lists.*','users.name as user_name','products.name as product_name','products.image as product_image')
        ->leftJoin('users','users.id','order_lists.user_id')
        ->leftJoin('products','products.id','order_lists.product_id')
        ->where('order_code', $roderCode)->get();
        //dd($orderList->toArray());
       return view('admin.order.productInfoList',compact('orderList'));

    }
}
