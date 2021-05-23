<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $items = [];
	public $totalQty;
	public $totalPrice;

    public function __construct($cart = null)
    {
		if($cart){
			$this->items = $cart->items;
			$this->totalPrice = $cart->totalPrice;
			$this->totalQty = $cart->totalQty;
		}else{
			$this->items= [];
			$this->totalQty = 0;
			$this->totalPrice = 0;
		}
	}

    public function add($product)
    {
		$item = [
			'id' => $product->id,
			'name' => $product->name,
			'price' => $product->price,
			'qty' => 0,
			'image' => $product->image
		];
		if(!array_key_exists($product->id, $this->items)){ //proveravamo da li je product u public $items = [];
			$this->items[$product->id] = $item; //$item je $item = [] iz ovog metoda -> add($product) 
			$this->totalQty+=1;
			$this->totalPrice+=$product->price;
		}else{
			$this->totalQty+=1;
			$this->totalPrice+=$product->price;
		}
		$this->items[$product->id]['qty']+=1;
	}
}
