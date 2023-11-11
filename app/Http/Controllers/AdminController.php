<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravolt\Avatar\Facade as Avatar;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    

    public function admin_login()
    {
        if (Auth::check()) {
            return redirect('admin/dashboard');
        }

        return view('admin.login');
    }


    public function login_action(Request $request)
    {


        $request->validate([
            'email'         => 'required|email',
            'password'      => 'required|min:6',
        ]);

       $user = User::role(['Admin'])->where('email', $request->email)->first();

            if ($user) {
                if (!Hash::check($request->password, $user->password)) {
                    return redirect()->back()->with('error', 'Incorrect credentials');
                }else{

                    $credentials = [
                        'email'     => $request->email,
                        'password'  => $request->password,
                    ];

                    if(Auth::attempt($credentials) == true){
                    return redirect('admin/dashboard');
                    }else{
                    return redirect()->back()->with('error', 'Incorrect credentials');
                    }
                }
            }else{

                return redirect()->back()->with('error', 'Incorrect credentials');
                
            }

    }


    public function logout()
    {

       Auth::logout();

       return redirect('auth/login');
    }

    public function change_password()
    {
        return view('admin.change-password');
    }

    

    public function password_update(Request $request)
    {


        $validator   =  Validator::make($request->all(), [
            'old_password'        => 'required',
            'password'            => 'required|min:6|confirmed',
        ]);
        
        if ($validator->fails())
        {
            return response()->json(['status' => 'errors', 'message'=>$validator->errors()->all()]);
        }

        if(Hash::check($request->old_password, auth()->user()->password) == false){
            return response()->json(['status' => 'error', 'message'=> 'Old password do not match']);
        }

        User::where('id', Auth::id())->update(['password' => bcrypt($request->password)]);
        
        return response()->json(['status' => 'success', 'message'=> 'Password  updated suceesfully', 'type' => 'store']);

    }


    public function index()
    {
        return view('admin.dashboard');
    }


    public function user()
    {
        $user = User::all();
        return view('admin.user', compact('user'));
    }

    
    
}
