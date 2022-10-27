<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //change password page
    public function changePasswordPage()
    {
        return view('admin.account.changePassword');
    }

    //Account
    public function details()
    {
        return view('admin.account.details');
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

    //account update page
    public function edit()
    {
        return view('admin.account.edit');
    }

    public function update($id, Request $request)
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
        return redirect()->route('admin#details')->with(['updateSuccess' => 'Admin Account Update Successfully']);
    }

    //admin list
    public function list()
    {
        $data = User::when(request('key'), function($query){
            $query->orWhere('name', 'like', '%'.request('key').'%')
            ->orWhere('email', 'like', '%'.request('key').'%')
            ->orWhere('gender', 'like', '%'.request('key').'%')
            ->orWhere('phone', 'like', '%'.request('key').'%')
            ->orWhere('address', 'like', '%'.request('key').'%');
        })
            ->where('role', 'admin')->paginate(3);
        $data->appends(request()->all());
        return view('admin.account.list', compact('data'));
    }


    //delete account
    public function delete($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Admin Account Deleted']);
    }

    //change Role
    public function changeRole($id)
    {
        $account = User::where('id', $id)->first();
        return view('admin.account.changeRole', compact('account'));
    }

    //change
    public function change($id, Request $request)
    {
        $data = $this->requestUserData($request);
        User::where('id', $id)->update($data);
        return redirect()->route('admin#list');
    }

    //request userdata
    private function requestUserData($request){
        return [
            'role' => $request->role
        ];
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
