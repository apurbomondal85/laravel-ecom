<?php

namespace App\Http\Controllers\Public;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->get();

        return view('public.pages.cart.index',[
            'carts' => $carts
        ]);
    }

    public function addToCart(Request $request)
    {
        $data = $request->all();
        $cartIdentifier = $request->cookie('cart_identifier');

        $cart = Cart::where('cart_identifier', $cartIdentifier)
                    ->where('product_id', $data['product_id'])->first();

        if ($cart) {
            $cart->update([
                'price'    => $data['price'],
                'quantity' => $cart->quantity + $data['quantity'],
            ]);
        } else {
            if (!$cartIdentifier) {
                $cartIdentifier = Str::uuid()->toString();
                Cookie::queue('cart_identifier', $cartIdentifier, 60 * 24 * 30); // Store for 30 days
            }

            $data['cart_identifier'] = $cartIdentifier;

            Cart::create($data);
        }

        return redirect()->back();
    }

    public function removeCart(Cart $cart)
    {
        $cart->delete();

        return redirect()->back();
    }
}
