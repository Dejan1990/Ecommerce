@extends('layouts.app')

@section('content')
<div class="container">
    <main role="main">

  <div class="container">
  <h2>Category</h2>
  @foreach($categories as $category)
    <a href="#">
      <button class="btn btn-secondary">{{ $category->name }}</button>
    </a>
  @endforeach
  <div class="album py-5 bg-light">
    <div class="container">
        <h2>Products</h2>
      <div class="row">
       @foreach($products as $product)
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img src="{{ Storage::url($product->image) }}" height="200" style="width: 100%">
            <div class="card-body">
                <p><b>{{ $product->name }}</b></p>
              <p class="card-text">
                {{ (Str::limit($product->description,120)) }}
              </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="{{ route('product.view', $product) }}">
                    <button type="button" class="btn btn-sm btn-outline-success">View</button>
                  </a>
                </a>
                <a class="addToCart" id="">
                    <button type="button" class="btn btn-sm btn-outline-primary">Add to cart</button>
                </a>
                </div>
                <small class="text-muted">${{ $product->price }}</small>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    <center>
        <a href="#">
          <button class="btn btn-success">More Product</button>
        </a>
    </center>
    </div>
  <div class="jumbotron">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="row">
        <!-- Foreach -->
        <div class="col-4">
                    <div class="card mb-4 shadow-sm">
            <img src="#" height="200" style="width: 100%">
            <div class="card-body">
                <p><b>RandomProductName</b></p>
              <p class="card-text">
                    RandomProduct description
              </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-success">View</button>
            <a href="">
            <a href="#">
                <button type="button" class="btn btn-sm btn-outline-primary">Add to cart</button>
            </a>
            </a>
                </div>
                <small class="text-muted">$700</small>
              </div>
            </div>
          </div>
        </div>
        <!-- Endforeach -->
      </div>
    </div>
    <div class="carousel-item ">
      <div class="row">
        <!-- Foreach -->

        <div class="col-4">
          <div class="card mb-4 shadow-sm">
            <img src="#" height="200" style="width: 100%">
            <div class="card-body">
                <p><b>randomItemProducts</b></p>
              <p class="card-text">
                randomItemProducts description
              </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                <a href="#">  <button type="button" class="btn btn-sm btn-outline-success">View</button></a>
                 <a href="#"> 
                <button type="button" class="btn btn-sm btn-outline-primary">Add to cart</button></a>
                </div>
                <small class="text-muted">$900</small>
              </div>
            </div>
          </div>
        </div>
        <!-- Endforeach -->
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
    </div>
  </div>
</main>

<footer class="text-muted">
  <div class="container">
    <p class="float-right">
      <a href="#">Back to top</a>
    </p>
    <p>Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
    <p>New to Bootstrap? <a href="https://getbootstrap.com/">Visit the homepage</a> or read our <a href="/docs/4.4/getting-started/introduction/">getting started guide</a>.</p>
  </div>
</footer>
</div>
@endsection 