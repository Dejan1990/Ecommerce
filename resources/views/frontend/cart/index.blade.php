@extends('layouts.app')

@section('content')
 <div class="container">

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Product</th>
      <th scope="col">Price</th>
      <th scope="col">Qty</th>
      <th scope="col">Remove</th>
    </tr>
  </thead>
  <tbody>

    <tr>
      <th scope="row">1</th>

      <td><img src="#" width="100"></td>
      <td>Product name</td>
      <td>$500</td>
      <td>
    <form action="#" method="post">
        @csrf
      	<input type="text" name="qty" value="1">
      	<button class="btn btn-secondary btn-sm">
      		<i class="fas fa-sync"></i>Update
      	</button>
      </form>
    </td>
      <td>
    <form action="#" method="post">
        @csrf
      	<button class="btn btn-danger">Remove</button>
      </form>
      </td>
    </tr>

  </tbody>
</table>
<hr>
<div class="card-footer">
	<a href="{{url('/')}}"><button class="btn btn-primary">Continue shopping</button></a>
	<span style="margin-left: 300px;">Total Price:$1200</span>
	<a href="#"><button class="btn btn-info float-right">Checkout</button></a>
</div>

<td>No items in cart</td>

 </div>
 @endsection