<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //cart list
    public function cartList()
    {
        $cartList = Cart::select('carts.*' ,'products.name as pizza_name', 'products.image as pizza_image', 'products.price as pizza_price')
        ->leftJoin('products', 'products.id', 'carts.product_id')
        ->where('carts.user_id', Auth::user()->id)
        ->get();
        return view('user.cart.cart', compact('cartList'));
    }
}
