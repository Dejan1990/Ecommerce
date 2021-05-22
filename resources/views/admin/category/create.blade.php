@extends('admin.layouts.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 ml-4 text-gray-800">Category</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Category</li>
        </ol>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-10">
        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
            @include('admin.category._form', [ 'buttonText' => 'Create Category' ]) 
          </form>
        </div>
    </div>
@endsection