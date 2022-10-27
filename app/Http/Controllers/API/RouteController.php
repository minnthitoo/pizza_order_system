<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    //products
    public function site_data()
    {
        $carts = Cart::get();
        $categories = Category::get();
        $contacts = Contact::get();
        $orders = Order::get();
        $order_lists = OrderList::get();
        $products = Product::get();
        $users = User::get();

        $products_data = [
            'carts' => $carts,
            'categories' => $categories,
            'contacts' => $contacts,
            'orders' => $orders,
            'order_lists' => $order_lists,
            'products' => $products,
            'users' => $users,
        ];
        return response()->json($products_data, 200);
    }
    public function categoryCreate(Request $request)
    {
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $response = Category::create($data);
        return response()->json($response, 200);
    }

    //delete category
    public function deleteCategory(Request $request)
    {
        $data = Category::where('id', $request->id)->first();
        if(isset($data)){
            Category::where('id', $request->id)->delete();
            return response()->json(['status' => true, 'message' => 'delete success'], 200);
        }else{
            return response()->json(['stuaus' => true, 'message' => 'There is no category'], 200);
        }
    }

    //category detail
    public function categoryDetail($id)
    {
        $data = Category::where('id', $id)->first();
        if(isset($data)){
            return response()->json(['status' => true, 'details' => $data], 200);
        }else{
            return response()->json(['stuaus' => true, 'message' => 'There is no category'], 200);
        }
    }

    //category update
    public function categoryUpdate(Request $request)
    {
        $dbC = Category::where('id', $request->id)->first();
        if(isset($dbC)){
            $data = $this->getCategoryData($request);
            Category::where('id', $request->id)->update($data);
            return response()->json(['message' => 'updated successfully'], 200);
        }else{
            return response()->json(['message'=>'There is no category'], 404);
        }

    }


    //category data
    private function getCategoryData($request){
        return [
            'name' => $request->category_name,
            'updated_at' => Carbon::now()
        ];
    }
}
