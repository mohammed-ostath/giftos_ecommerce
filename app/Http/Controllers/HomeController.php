<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home() {
        $products = Product::all(); // Fetch all products
        return view('home.index', compact('products'));
    }


    public function login_home() {
        $products = Product::with('category')->get();
        $user = Auth::user(); // Get the currently logged-in user
        $count = $user ? Cart::where('user_id', $user->id)->count() : 0;

        return view('home.index', compact('products', 'count'));
    }


    public function product_details(int $id) {
        $user = Auth::user();
        $count = $user ? Cart::where('user_id', $user->id)->count() : 0;
        $product = Product::with('category')->findOrFail($id);
        return view('home.product_details', compact('product', 'count'));
    }

    public function add_cart($id) {
        $user = Auth::user();
        if (!$user) {
            return redirect()->back()->with('error', 'You need to log in to add items to the cart.');
        }

        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        // Add the product to the cart
        $data = new Cart;
        $data->user_id = $user->id;
        $data->product_id = $id;
        $data->save();

        return redirect()->back()->with('success', 'Product added to cart successfully');
    }

    public function mycart() {
        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $count = $user ? Cart::where('user_id', $user->id)->count() : 0;
            $cart = Cart::where('user_id',$userid)->with('product')->get();
        }
        return view('home.mycart', compact('count','cart'));
    }

    public function removecart($id){
        $cartItem = Cart::findOrFail($id);
        if ($cartItem->user_id === Auth::id()) {
            $cartItem->delete();
        }
        return redirect()->back()->with('success','Product Successfully Removed From Cart');
    }

    public function confirm_order(Request $request){
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;
        $userid = Auth::user()->id;

        // Get all products from the user's cart
        $cart = Cart::where('user_id', $userid)->with('product')->get();

        // Iterate over each product in the cart
        foreach ($cart as $carts) {
            $order = new Order;  // Create a new Order instance
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $userid;
            $order->product_id = $carts->product_id;
            $order->save();
        }
        $cart_remove = Cart::where('user_id',$userid)->with('product')-get();
        foreach ($cart_remove as $cart_remove) {
            $cart_remove->delete();
        }

        return redirect()->back();
    }

}
