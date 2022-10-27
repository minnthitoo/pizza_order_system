<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //order list
    public function orderList()
    {
        $order = Order::select('orders.*', 'users.name as username')
            ->when(request('orderCode'), function ($query) {
                $query->where('orders.order_code', 'like', '%' . request('orderCode') . '%');
            })
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->orderBy('created_at', 'desc')
            ->paginate('5');
        $order->appends(request()->all());
        return view('admin.order.list', compact('order'));
    }

    //ajax sorting
    public function changeStatus(Request $request)
    {
        $order = Order::select('orders.*', 'users.name as username')
                ->when(request('orderCode'), function ($query) {
                    $query->where('orders.order_code', 'like', '%' . request('orderCode') . '%');
                })
                ->leftJoin('users', 'users.id', 'orders.user_id')
                ->orderBy('created_at', 'desc');
        if($request->orderStatus == null){
                $order = $order->get();
        } else {
            $order = $order->where('orders.status', $request->orderStatus)->get();
        }
        // logger($request->all());
        return view('admin.order.list', compact('order'));

    }
    public function ajaxChangeStatus(Request $request)
    {
        logger($request->all());
        Order::where('id', $request->orderId)->update([
            'status'=>$request->status
        ]);
        return response()->json(['message'=>'success'], 200);
    }

    //listinfo
    public function listInfo($orderCode)
    {
        $order = Order::where('order_code', $orderCode)->first();
        $orderList = OrderList::select('order_lists.*', 'users.name as username', 'products.image as product_image', 'products.name as product_name')
        ->leftJoin('users', 'users.id', 'order_lists.user_id')
        ->leftJoin('products', 'product_id', 'order_lists.product_id')
        ->where('order_code', $orderCode)
        ->get();
        // dd($orderList->toArray());
        return view('admin.order.productList', compact('orderList', 'order'));
    }
}
