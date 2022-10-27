<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //userlist
    public function userList()
    {
        $users = User::when(request('name'), function($query){
            $query->where('name', 'like', '%'.request('name').'%');
        })
        ->where('role', 'user')->paginate('3');
        $users->appends(request()->all());
        return view('admin.user.list', compact('users'));
    }

    //ajax change role
    public function ajaxChangeRole(Request $request)
    {
        logger($request->all());
        User::where('id', $request->userId)->update([
            'role' => $request->currentRole
        ]);
        $response = ['message' => 'done'];
        return response()->json($response, 200);
    }

    //user message
    public function message()
    {
        $messages = Contact::paginate('5');
        return view('admin.user.message', compact('messages'));
    }

    public function messageDelete(Request $request)
    {
        Contact::where('id', $request->id)->delete();
        return response()->json(['message'=>'success'], 200);
    }
}
