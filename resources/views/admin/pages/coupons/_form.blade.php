@csrf
<div class="form-row">
    <div class="form-group col-md-4">
        <label for="title">Banner Name</label><span class="text-danger">*</span>
        <input type="text" name="title" class="form-control" placeholder="Banner name"
            value="{{ old('title', $banner_data['title']) }}">
    </div>
    <div class="form-group col-md-4 mt-4">
        <div class="custom-file mt-2">
            <label class="custom-file-label" for="customFile">Choose Photo</label>
            <input type="file" class="custom-file-input" id="customFile" name="banner_image" accept="image/*">
        </div>
    </div> 
</div>
<button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
