<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request){

        $user = User::latest('id');
        if ($request->get('keyword') != "") {
            $user = $user->where('first_name', 'like', '%' . $request->get('keyword') . '%');
        }

        $user = $user->paginate();
        $data['user'] = $user;

        return view('admin.users.user-list', $data);
    }

    public function edit($id, Request $request){
        $user = User::find($id);
        if (empty($user)) {
            return redirect()->route('user.index');
        }
        return view('admin.users.user-edit', compact('user'));
    }

    public function update($id, Request $request){
        $user = User::find($id);
        if (empty($user)) {
            $request->session()->flash('error', 'User Not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'User not found'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->passes()) {
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->nick_name = $request->nick_name;
            $user->register_from = $request->register_from;
            $user->save();

            session()->flash('success', 'User Update Successfully.');

            return response()->json([
                'status' => true,
                'message' => 'User Update Successfully'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function delete($id, Request $request){
        $user = User::find($id);
        if (empty($user)) {
            $request->session()->flash('error', 'User Not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'User not found'
            ]);
        }
        $user->delete();

        session()->flash('success', 'User Deleted Successfully');

        return response()->json([
            'status' => true,
            'message' => 'User Deleted Sucessfully'
        ]);
    }
}
