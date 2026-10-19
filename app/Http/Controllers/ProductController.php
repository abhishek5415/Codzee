<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $bestSellers = Product::all();
        $newArrivals = Product::where('type','new-arrivals')->get();
        $hotSales = Product::where('type','hot-sales')->get();
        $wishlist = Wishlist::where('customerId', session()->get('id'))->pluck('productId')->toArray();
        return view('Customer.index',compact('bestSellers','newArrivals','hotSales','wishlist')); 
    }

    public function productView($id){
        $product = Product::find($id);
        return view('Customer.productview',compact('product'));
    }

    public function addToCart(Request $request){
        if(session()->has('id')){                 //checking if the user is logged in or not
            $input = $request->validate([
                'quantity'=>'required',
            ]);
            $input['productId'] = $request->id;
            $input['customerId'] = session()->get('id');
            Cart::create($input);
            $wishlist = Wishlist::where('productId',$request->id);
            if($wishlist->count() != 0){
                $wishlist->delete();
            }
            return redirect()->back()->with('status','Item added to cart Successfully!!');
        }
        else{
            return redirect('/login')->with('error','Please login to continue!!');
        }
    }

    public function cart(){
        if(session()->has('id')){ 
            $cartItem = DB::table('products')
            ->join('carts','carts.productId','products.id')
            ->select('carts.*','products.title','products.price','products.picture','products.quantity as pQuantity')
            ->where('carts.customerId',session()->get('id'))
            ->get();
            return view('Customer.cart',compact('cartItem'));
        }
        else{
            return redirect('/login')->with('error','Please login to continue!!');
        }
    }

    public function updateCartItem(Request $request, $id){
        $cartItem = Cart::find($id);
        $input = $request->validate([
            'quantity'=>'required',
        ]);
        $cartItem->update($input);
        return redirect()->back()->with('status','Item updated successfully!!');
    }

    public function deleteCartItem($id){
        $cartItem = Cart::find($id);
        $cartItem->delete();
        return redirect()->back()->with('status','Item Removed from Cart!!');
    }

    public function checkout(Request $request){
        $input = $request->validate([
            'fullname'=>'required',
            'phone'=>'required',
            'address'=>'required'
        ]);
        $input['customerId'] = session()->get('id');
        $input['status'] = 'pending';
        $input['bill'] = $request->bill;
        $order = Order::create($input);
        if($order){
            $carts = Cart::where('customerId',session()->get('id'))->get();
            foreach ($carts as $cart) {
                $product = Product::find($cart->productId);
                $orderItems = new OrderItem();
                $orderItems->productId = $cart->productId;
                $orderItems->quantity = $cart->quantity;
                $orderItems->price = $product->price;
                $orderItems->orderId = $order->id;
                $orderItems->save();
                if ($product->quantity >= $cart->quantity) {
                    $product->quantity -= $cart->quantity;
                    $product->save();
                }else{
                    return redirect()->back()->with("status","Insufficient quantity for product ID: {$product->id}");
                }
                $cart->delete();
            }
        }
        return redirect()->back()->with('status','Your order has been placed successfully!!');
    }

    public function myorders(){
        if(session()->has('id')){ 
            $orders = Order::where('customerId',session()->get('id'))->get();
            $product = DB::table('products')
            ->join('order_items','order_items.productId','products.id')
            ->select('products.title','products.picture','order_items.*')    //I have taken the price from order item because i want the same price at ordered time
            ->get();
            return view('Customer.orders',compact('orders','product'));
        }
        else{
            return redirect('/login')->with('error','Please login to continue!!');
        }
    }

    public function shop(Request $request){
        $search = $request->search ?? "" ;
        $sort = $request->sort;
        $wishlist = Wishlist::where('customerId', session()->get('id'))->pluck('productId')->toArray();
        if($search != ""){
            $products = Product::where('title','LIKE',"%$search%")->orWhere('price','LIKE',"%$search%")->get();
        }else{
            $products = Product::get();
        }

        if($sort == 'lowestFirst'){
            $products = Product::orderBy('price','ASC')->get();
        }elseif($sort == 'highestFirst'){
            $products = Product::orderBy('price','DESC')->get();
        }

        return view('Customer.shop',compact('products','wishlist'));
    }

    public function wishlist(){
        if (session()->has('id')) {
            $wishlists = DB::table('products')
            ->join('wishlists','products.id','wishlists.productId')
            ->select('products.*','wishlists.quantity','wishlists.customerId','wishlists.id as wId')
            ->where('wishlists.customerId',session()->get('id'))
            ->get();
            return view('Customer.wishlist',compact('wishlists'));
        } else {
            return redirect('/login')->with('error', 'Please login to continue!!');
        }
    }

    public function addToWishlist($id){
        if (session()->has('id')) {
            $customerId = session()->get('id');
            $wishlistItem = Wishlist::where('customerId', $customerId)
                                    ->where('productId', $id)
                                    ->first();
            if (!$wishlistItem) {
                $wishlistItem = new Wishlist();
                $wishlistItem->customerId = $customerId;
                $wishlistItem->productId = $id;
                $wishlistItem->quantity = 1;
                $wishlistItem->save();

                return redirect()->back()->with('status', 'Product added to wishlist Successfully!!');
            } else {
                return redirect()->back()->with('status', 'Product is already in your wishlist.');
            }
        } else {
            return redirect('/login')->with('error', 'Please login to continue!!');
        }
    }

    public function deleteWishlistItem(Request $request){
        $wishlist = Wishlist::where('productId',$request->id);
        if($wishlist->count() != 0){
            $wishlist->delete();
        }
        return redirect()->back()->with('status','Product Removed from Wishlist!!');
    }

}
