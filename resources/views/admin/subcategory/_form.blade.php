@csrf
<div class="card mb-6">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Update SubCategory</h6>
    </div>
    <div class="card-body">
        <div class="form-group"> 
          <label for="">Name</label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="" aria-describedby="" placeholder="Enter name of subcategory" value="{{ old('name', $subcategory->name) }}">
          @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="">Choose Category</label>
            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
              <option value="">select</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}"
                  @if ($subcategory->category)
                    @if($category->id === $subcategory->category->id)selected
                    @endif
                  @endif
                  >{{ $category->name }}</option>
              @endforeach
            </select>
           @error('category_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
    </div>
  </div>