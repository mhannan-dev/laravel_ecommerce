@csrf
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="title">Category name</label><span class="text-danger">*</span>
        <input type="text" name="title" class="form-control" placeholder="Category title"
            value="{{ old('title', $category->title) }}">
    </div>
    <div class="form-group col-md-6">
        <label for="section_id">Section</label> <span class="text-danger">*</span>
        <select class="form-control select2bs4" id="section_id" name="section_id">
            <option value="">Select section</option>
            @foreach ($getSection as $section)
            <option value="{{ $section->id }}" @if (!empty($category['section_id']) &&
                $category['section_id']==$section->id) selected @endif>{{ $section->title }}</option>

            @endforeach
        </select>
    </div>
    <div id="append_category" class="col-md-6">
        @include('admin.pages.category._append')

    </div>
    <div class="form-group col-md-6">
        <label for="discount_amt">Discount</label><span class="text-danger">*</span>
        <input type="text" name="discount_amt" class="form-control" placeholder="Category discount"
            value="{{ old('discount_amt', $category->discount_amt) }}">
    </div>

    <div class="form-group col-md-6">
        <label for="meta_title">Meta title</label> <span class="text-danger">*</span>
        <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Meta title"
            value="{{ old('meta_title', $category->meta_title) }}">
    </div>
    <div class="form-group col-md-6 mt-4">
        <div class="custom-file mt-2">
            <label class="custom-file-label" for="customFile">Choose Photo</label>
            <input type="file" class="custom-file-input" id="customFile" name="image" accept="image/*">
        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="description">Description</label> <span class="text-danger">*</span>
        <textarea placeholder="Description" class="form-control" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
    </div>
    <div class="form-group col-md-6">
        <label for="meta_description">Meta description</label> <span class="text-danger">*</span>


            <textarea placeholder="Meta Description" class="form-control" name="meta_description" rows="3">{{ old('meta_description', $category->meta_description) }}</textarea>
    </div>


</div>
<button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
