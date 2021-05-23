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
}
