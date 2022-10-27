<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //userHome page
    public function home()
    {
        $pizza = Product::get();
        $category = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('pizza', 'category', 'cart', 'history'));
    }

    //change password page
    public function changePasswordPage()
    {
        return view('user.password.change');
    }

    //change password
    public function changePassword(Request $request)
    {
        $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbpassword = $user->password;
        if (Hash::check($request->oldPassword, $dbpassword)) {
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id', Auth::user()->id)->update($data);
            Auth::logout();
            return redirect()->route('auth#loginPage');
        }

        return back()->with(['notMatch' => 'The Old password not match. Try Again!']);
    }

    //account change
    public function accountChangePage()
    {
        return view('user.profile.account');
    }

    //account change
    public function accountChange($id, Request $request)
    {
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //for image

        if ($request->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                Storage::delete('public/', $dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        User::where('id', $id)->update($data);
        return back()->with(['updateSuccess' => 'User Account Update Successfully']);
    }

    //filter pizza
    public function filter($category_id)
    {
        $pizza = Product::where('category_id', $category_id)->get();
        $category = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('pizza', 'category', 'cart', 'history'));
    }

    //direct pizza detail

    public function pizzaDetails($pizzaId)
    {
        $pizza = Product::where('id', $pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details', compact('pizza', 'pizzaList'));
    }


    //history check
    public function history()
    {
        $order = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate('4');
        return view('user.main.history', compact('order'));
    }

    //contact us
    public function contactForm()
    {
        return view('user.contact.contact');
    }

    public function contact(Request $request)
    {
        Contact::create([
            'name' => $request->userName,
            'email' => $request->userEmail,
            'message' => $request->userMessage
        ]);
        return redirect()->route('user#home');
    }

    //password validation
    private function passwordValidationCheck($request)
    {
        Validator::make(
            $request->all(),
            [
                'oldPassword' => 'required',
                'newPassword' => 'required|min:6|max:10',
                'confirmPassword' => 'required|min:6|max:10|same:newPassword',
            ]
        )->validate();
    }

    //validation check
    private function accountValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'image' => 'mimes:png,jpg,jpeg|file',
            'gender' => 'required',
            'address' => 'required'
        ])->validate();
    }

    //getuserdata
    private function getUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address
        ];
    }
}
