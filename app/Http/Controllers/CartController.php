<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
//use App\Mail\Sendmail;

class CartController extends Controller
{
    public function addToCart(Product $product, Request $request){
    	//return $product;

        /*if(session()->has('cart')){ // ovo 'cart' je isto 'cart' iz session()->put('cart',$cart);
    		$cart = new Cart(session()->get('cart'));
    	}else{
    		$cart = new Cart();
    	}*/

    	$cart = $this->setCart();
		$cart->add($product);

    	session()->put('cart', $cart);
    	notify()->success('Product added to cart!');
        return back();
    }

	public function showCart()
	{
    	$cart = $this->setCartNull();

    	return view('frontend.cart.index', [
			'cart' => $cart
		]);
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

	public function checkout($amount)
	{
        $cart = $this->setCartNull();

        return view('frontend.cart.checkout', [
			'cart' => $cart,
			'amount' => $amount
		]);
    }

	public function charge(Request $request)
	{
        $charge = Stripe::charges()->create([
            'currency'=>"USD",
            'source'=>$request->stripeToken, //stripeToken->checkout.blade.php 156 linija koda
            'amount'=>$request->amount,//hidden input polje iz checkout.blade.php 62 linija koda
            'description'=>'Test'
        ]);

        $chargeId = $charge['id']; //$charge je ovo iznad $charge
		/*if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }else{
            $cart = null;
        } 
        \Mail::to(auth()->user()->email)->send(new Sendmail($cart)); ovo koristimo kad ubacim mail
        */
        if($chargeId){
            auth()->user()->orders()->create([
                'cart' => serialize(session()->get('cart'))
            ]);

            session()->forget('cart');
            notify()->success('Transaction completed!');
            return redirect()->to('/');
        }else{
            return redirect()->back();
        }
    }

	//for loggedin user
    public function order()
	{
        $orders = auth()->user()->orders;
        $carts = $orders->transform(function($cart, $key){
            return unserialize($cart->cart);
        });
		
        return view('frontend.order.index', [ 
			'carts' => $carts 
		]);
    }

	//for admin
    public function userOrder()
    {
        $orders = Order::latest()->get();
        return view('admin.order.index', [
			'orders' => $orders
		]);
    }

	public function viewUserOrder($userid, $orderid)
    {
        $user = User::find($userid);
        $orders = $user->orders->where('id', $orderid);
        $carts = $orders->transform(function($cart,$key){
            return unserialize($cart->cart);
        });
        return view('admin.order.show', [ 'carts' => $carts ]);
    }

	private function setCart() 
	{
		if(session()->has('cart')){ 
    		$value = new Cart(session()->get('cart'));
    	}else{
    		$value = new Cart();
    	}

		return $value;
	}

	private function setCartNull()
	{
		if(session()->has('cart')){ 
    		$value = new Cart(session()->get('cart'));
    	}else{
    		$value = null;
    	}

		return $value;
	}
}
