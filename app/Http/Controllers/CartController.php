<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Product $product, Request $request){
    	//return $product;

        if(session()->has('cart')){ // ovo 'cart' je isto 'cart' iz session()->put('cart',$cart);
    		$cart = new Cart(session()->get('cart'));
    	}else{
    		$cart = new Cart();
    	}

    	$cart->add($product);

    	session()->put('cart', $cart);
    	notify()->success('Product added to cart!');
        return back();
    }

	public function showCart()
	{
    	if(session()->has('cart')){
    		$cart = new Cart(session()->get('cart'));
    	}else{
    		$cart = null;
    	}

    	return view('frontend.cart.index', compact('cart'));
    }

	public function updateCart(Request $request, Product $product)
	{
    	$request->validate([
    		'qty'=>'required|numeric|min:1'
    	]);

    	$cart = new Cart(session()->get('cart'));
    	$cart->updateQty($product->id, $request->qty);
    	session()->put('cart', $cart);
    	notify()->success('Cart updated!');
        return redirect()->back();
    }

	public function removeCart(Product $product)
	{
    	$cart = new Cart(session()->get('cart'));
    	$cart->remove($product->id);
    	if($cart->totalQty<=0){ //$cart->totalQty<=0 totalQty equal or less than 0
    		session()->forget('cart');
    	}else{
    		session()->put('cart', $cart);
    	}
    	notify()->success('Cart updated!');
        return redirect()->back();
    }
}
