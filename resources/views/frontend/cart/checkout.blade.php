@extends('layouts.app')

@section('content')
@include('frontend.partials.styles')
<div class="container">
   <div class="row">
    <div class="col-md-6">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Product</th>
            <th scope="col">Price</th>
            <th scope="col">Qty</th>
          </tr>
        </thead>
      <tbody>
      @if($cart)
      @php $i=1 @endphp
      @foreach($cart->items as $product)
        <tr>
          <th scope="row">{{ $i++ }}</th>
          <td><img src="{{ Storage::url($product['image']) }}" width="100"></td>
          <td>{{ $product['name'] }}</td>
          <td>${{ $product['price'] }}</td>
          <td>{{ $product['qty'] }}</td>
          <td></td>
        </tr>
      @endforeach
      @endif
      </tbody>
    </table>
    <hr>
    Total Price:${{$cart->totalPrice}}
  </div>
 	<div class="col-md-6">
 		<div class="card">
 			<div class="card-header">Checkout</div>
 			<div class="card-body">
 	      <form action="/charge" method="post" id="payment-form">
              @csrf
              <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" id="name" class="form-control" required="" value="{{ auth()->user()->name }}" readonly>
              </div>
              <div class="form-group">
                  <label>Adress</label>
                  <input type="text" name="address" id="address" class="form-control" required="">
              </div>
              <div class="form-group">
                  <label>City</label>
                  <input type="text" name="city" id="city" class="form-control" required="">
               </div>
              <div class="form-group">
                  <label>State</label>
                  <input type="text" name="state" id="state" class="form-control" required="">
              </div>
              <div class="form-group">
                  <label>Postal code</label>
                  <input type="text" name="postalcode" id="postalcode" class="form-control" required="">
              </div>
              <div class="">
                  <input type="hidden" name="amount" value="{{$amount}}">
                      <div class="">
                        <label for="card-element">
                          Credit or debit card
                        </label>
                        <div id="card-element">
                          <!-- A Stripe Element will be inserted here. -->
                        </div>
                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                      </div>
                  <button class="btn btn-primary mt-4" type="submit">Submit Payment</button>
              </div>
          </form>
          </div>
        </div>
    </div>
   </div>
</div>
@include('frontend.partials.scripts')
@endsection