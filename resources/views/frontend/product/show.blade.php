@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="row">
        <aside class="col-sm-5 border-right">
            <section class="gallery-wrap"> 
            <div class="img-big-wrap">
              <div> <a href="#">
                <img src="{{ Storage::url($product->image) }}" width="450"></a>
              </div>
            </div> 
            </section> 
        </aside>
        <aside class="col-sm-7">
            <section class="card-body p-5">
                <h3 class="title mb-3">{{ $product->name }}</h3>
                <p class="price-detail-wrap"> 
                    <span class="price h3 text-danger"> 
                        <span class="currency">US $</span>{{$product->price}}
                    </span> 
                </p> <!-- price-detail-wrap .// -->
                <h3>Description</h3>
                <p>{!! $product->description !!}</p>
                <h3>Additional information</h3>
                <p>{!! $product->additional_info !!}</p>
                 <!-- quantity -->
                <hr>
                <a href="#" class="btn btn-lg btn-outline-primary text-uppercase">Add to cart</a>
            </section> 
        </aside> 
    </div> 
  </div> 
</div>
@endsection