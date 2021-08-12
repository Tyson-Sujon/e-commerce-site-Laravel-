<?php

namespace App\Http\Controllers;

use App\Models\Atrribute;
use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartController extends Controller
{
    //
    public function CartView()
    {
        // return Cart::all();
        $carts = Cart::with(['GetColor', 'GetProduct', 'GetSize'])->where('cookie_id', Cookie::get('cookie_id'))->get();
        return view('frontend.pages.cart_view', compact('carts'));
    }
    public function CartPost(Request $request)
    {
        $request->validate([
            'color_id' => 'required',
            'size_id' => 'required',
            'quantity' => 'required'
        ], [
            'color_id.required' => 'Please! Choose a color',
            'size_id.required' => 'Please! Choose a size'
        ]);
        if ($request->hasCookie('cookie_id')) {
            $random_generated_coockie_id = $request->cookie('cookie_id');
            $cart_before = Cart::with(['GetColor', 'GetProduct', 'GetSize'])->where('cookie_id', $random_generated_coockie_id)->where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->first();

            if ($cart_before) {
                $cart_before->increment('quantity', $request->quantity);
                return back();
            } else {
                $cart = new Cart();
                $cart->cookie_id = $random_generated_coockie_id;
                $cart->product_id = $request->product_id;
                $cart->quantity = $request->quantity;
                $cart->color_id = $request->color_id;
                $cart->size_id = $request->size_id;
                $cart->save();
                return back();
            }
        } else {
            $random_generated_coockie_id = time() . Str::random(10);
            Cookie::queue('cookie_id', $random_generated_coockie_id, 1440);
            $cart = new Cart();
            $cart->cookie_id = $random_generated_coockie_id;
            $cart->product_id = $request->product_id;
            $cart->quantity = $request->quantity;
            $cart->color_id = $request->color_id;
            $cart->size_id = $request->size_id;
            $cart->save();

            return back();
        }
    }

    public function DeleteCart($id)
    {
        Cart::findorFail($id)->delete();
        return back();
    }
    // return $request->except('_token');
}
