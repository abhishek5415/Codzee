<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function registerView(){
        return view('Customer.register');
    }

    public function register(Request $request){
        $input = $request->validate([
            'fullname'=> 'required | string',
            'email'=> 'required',
            'picture'=> 'required | image',
            'password'=> 'required | min:5',
        ]);
        if($request->hasFile('picture')){
            $picture = $request->file('picture')->getClientOriginalName();
            $request->file('picture')->move('uploads/profiles/',$picture);
            $input['picture'] = $picture;
        }
        User::create($input);
        return redirect('/login')->with('status','User Registered Successfully!!');
    }

    public function loginView(){
        return view('Customer.login');
    }

    public function login(Request $request){
        $input = $request->validate([
            'email'=> 'required',
            'password'=> 'required',
        ]);
        
        if(auth()->attempt(['email'=> $input['email'], 'password'=> $input['password']])){
            $user = User::where('email',$input['email'])->first();
            if($user->status == 'Active'){
                session()->put('id',$user->id);
                session()->put('role',$user->role);
                if($user->role == 'Customer'){
                    return redirect('/');
                }else if($user->role == 'Admin'){
                    return redirect('/admin');
                }
            }else{
                return redirect('/login')->with('error','Your status is blocked!!');
            }  

        }else{
            return redirect('/login')->with('error','Invalid Email address or password!!');
        }
    }

    public function logout(){
        session()->forget('id');
        session()->forget('role');
        return redirect('/login');
    }

    public function profile(){
        if(session()->has('id')){
            $user = User::find(session()->get('id'));
            return view('Customer.profile',compact('user'));
        }
        else{
            return redirect('/login')->with('error','Please login to continue!!');
        }   
    }

    public function updateProfile(Request $request){
        $user = User::find(session()->get('id'));
        $user->fullname= $request->input('fullname');
        if($request->input('password') != null){
            $user->password= $request->input('password');
        }
        if($request->file('picture') != null){
            $user->$picture = $request->file('picture')->getClientOriginalName();
            $request->file('picture')->move('uploads/profiles/',$picture);
        }
        $user->save();
        return redirect()->back()->with('status','Contratulations! Your Account is updated.');
    }
}
