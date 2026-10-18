<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        if (session()->has('id')) {
            $user = User::find(session()->get('id'));
            $products = Product::get();
            $customers = User::where('role','Customer');
            $orders = Order::get();
            return view('Admin.index',compact('user','products','customers','orders'));
        } else {
            return redirect('/login')->with('error', 'Please login to continue!!');
        }
    }

    public function adminProducts(){
        if (session()->has('id')) {
            $products = Product::all();
            return view('Admin.products',compact('products'));
        } else {
            return redirect('/login')->with('error', 'Please login to continue!!');
        }
    }

    public function addProducts(Request $request){
        if (session()->has('id')) {
            $input = $request->validate([
                'title'=>'required',
                'description'=>'required',
                'picture'=>'required',
                'price'=>'required',
                'quantity'=>'required',
                'category'=>'required',
                'type'=>'required',
            ]);
            if($request->hasFile('picture')){
                $picture = $request->file('picture')->getClientOriginalName();
                $request->file('picture')->move('uploads/products/',$picture);
                $input['picture'] = $picture;
            }
            Product::create($input);
            return redirect()->back()->with('status','Product Added successfully!!');
        } else {
            return redirect('/login')->with('error', 'Please login to continue!!');
        }
    }

    public function updateProducts(Request $request){
        if (session()->has('id')) {
            $product = Product::find($request->id);
            $input = $request->validate([
                'title'=>'required',
                'description'=>'required',
                'price'=>'required',
                'quantity'=>'required',
                'category'=>'required',
                'type'=>'required',
            ]);
            if($request->file('picture') != null){
                $picture = $request->file('picture')->getClientOriginalName();
                $request->file('picture')->move('uploads/products/',$picture);
                $input['picture'] = $picture;
            }
            $product->update($input);
            return redirect()->back()->with('status','Product Updated successfully!!');
        } else {
            return redirect('/login')->with('error', 'Please login to continue!!');
        }
    }

    public function deleteProducts($id){
        if (session()->has('id')) {
            $product = Product::find($id);
            $product->delete();
            return redirect()->back()->with('status2','Product Deleted successfully!!');
        } else {
            return redirect('/login')->with('error', 'Please login to continue!!');
        }
    }

    public function adminCustomers(){
        if (session()->has('id')) {
            $customers = User::where('role','Customer')->get();
            return view('Admin.customers',compact('customers'));
        } else {
            return redirect('/login')->with('error', 'Please login to continue!!');
        }
    }

    public function changeUserStatus($status, $id){
        if (session()->has('id')) {
            $customer = User::find($id);
            $customer->status = $status;
            $customer->save();
            return redirect()->back()->with('status','User Status Updated successfully!!');
        } else {
            return redirect('/login')->with('error', 'Please login to continue!!');
        }    
    }

    public function addCustomer(Request $request){
        if (session()->has('id')) {
            $input = $request->validate([
                'fullname'=>'required',
                'email'=>'required',
                'password'=>'required | min:5',
                'picture'=>'required',
                'role'=>'required',
            ]);
            if($request->hasFile('picture')){
                $picture = $request->file('picture')->getClientOriginalName();
                $request->file('picture')->move('uploads/profiles/',$picture);
                $input['picture'] = $picture;
            }
            User::create($input);
            return redirect()->back()->with('status','User Added successfully!!');
        } else {
            return redirect('/login')->with('error', 'Please login to continue!!');
        } 
    }

    public function profile(){
        if(session()->has('id')){
            $user = User::find(session()->get('id'));
            return view('Admin.profile',compact('user'));
        }
        else{
            return redirect('/login')->with('error','Please login to continue!!');
        }   
    }

    public function logout(){
        if(session()->has('id')){
            session()->forget('id');
            session()->forget('role');
            return redirect('/login');
        } else {
            return redirect('/login')->with('error', 'Please login to continue!!');
        }
    }

    public function updateProfile(Request $request){
        if(session()->has('id')){
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
        } else {
            return redirect('/login')->with('error', 'Please login to continue!!');
        }
    }

    public function adminOrders(){
        if(session()->has('id')){
            $orders = Order::get();
            $products = DB::table('products')
            ->join('order_items','products.id','order_items.productId')
            ->select('order_items.*','products.title','products.picture')
            ->get();
            return view('Admin.orders',compact('orders','products'));
        } else {
            return redirect('/login')->with('error', 'Please login to continue!!');
        }
    }

    public function changeOrderStatus($status, $id){
        if(session()->has('id')){
            $orders = Order::find($id);
            $orders->status = $status;
            $orders->save();
            if($status == 'Rejected'){
                $orderItems = OrderItem::where('orderId', $id)->get();
                foreach ($orderItems as $orderItem) {
                    $product = Product::where('id', $orderItem->productId)->first();   // for single row do not use get() use first()
                    $product->quantity += $orderItem->quantity;
                    $product->save();
                }
            return redirect()->back()->with('status','Order Status Changed Successfully');
        } else {
            return redirect('/login')->with('error', 'Please login to continue!!');
        }
        }
    }
}
