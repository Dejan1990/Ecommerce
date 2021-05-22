@csrf
<div class="card mb-6">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Update Category</h6>
    </div>
    <div class="card-body">
        <div class="form-group"> 
          <label for="">Name</label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="" aria-describedby=""
            placeholder="Enter name of category" value="{{ old('name', $category->name) }}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="">Description</label>
          <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description) }}</textarea>
           @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
          @enderror
        </div>
        <div class="form-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input mb-4 @error('image') is-invalid @enderror" id="customFile" name="image">
            <label class="custom-file-label" for="customFile">Choose file</label>
            @if ($category->image)
                <img src="{{ Storage::url($category->image) }}" width="100" height="100">
            @endif
            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>
        <br><br><br><br>
        <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
    </div>
  </div>