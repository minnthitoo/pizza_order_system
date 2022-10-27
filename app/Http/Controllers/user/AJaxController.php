<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AJaxController extends Controller
{
    //pizza List
    public function pizzaList(Request $request)
    {
        if ($request->status == 'desc') {
            $data = Product::orderBy('created_at', 'desc')->get();
        } else {
            $data = Product::orderBy('created_at', 'asc')->get();
        }
        return $data;
    }

    //add to cart
    public function addToCart(Request $request)
    {
        $data = $this->getOrderData($request);
        logger($data);
        Cart::create($data);
        //response
        $response = [
            'message' => 'Add to Cart Completely',
            'status' => 'success'
        ];
        return response()->json($response, 200);
    }

    //order
    public function order(Request $request)
    {
        $total = 0;
        foreach ($request->all() as $item) {
            $total += $item['total'];
            $data = OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code']
            ]);
        }

        Cart::where('user_id', Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total + 3000
        ]);

        return response()->json([
            'status' => 'true',
            'message' => 'order complated'
        ], 200);
    }

    //clear cart
    public function clearCart()
    {
        Cart::where('user_id', Auth::user()->id)->delete();
    }

    //clear currengt product
    public function clearCurrentProduct(Request $request)
    {
        Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $request->productId)
            ->where('id', $request->orderId)
            ->delete();
    }

    //view Count
    public function increaseViewCount(Request $request)
    {
        $pizza = Product::where('id', $request->productId)->first();
        $count = $pizza->view_count;
        Product::where('id', $request->productId)->update([
            'view_count' => $count + 1
        ]);
        logger($count);
    }


    //get order data
    private function getOrderData($request)
    {
        return [
            'user_id' => (int)$request->userId,
            'product_id' => (int)$request->pizzaId,
            'qty' => (int)$request->count,
        ];
    }
}
