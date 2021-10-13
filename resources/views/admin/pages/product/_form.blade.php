@csrf
<div class="form-row">
    <div class="form-group col-md-4">
        <label for="category_id">Category</label> <span class="text-danger">*</span>
        <select name="category_id" class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}" id="category_id">
            <option value="">Select</option>
            @foreach ($categories as $section)
            <optgroup label="{{ $section['title'] }}"></optgroup>
            @foreach ($section['categories'] as $category)
            <option value="{{ $category['id'] }}" @if (!empty(@old('category_id')) && $category['id']==@old('category_id')) selected="" @elseif(!empty($product_data['category_id']) && $product_data['category_id']==$category['id']) selected @endif>&nbsp;&#8594;&#8594;{{ $category['title'] }}</option>
            @foreach ($category['subcategories'] as $subcategory)
            &#8594;&#8594;&#8594;<option value="{{ $subcategory['id'] }}" @if(!empty(@old('category_id')) && $subcategory['id']==@old('category_id')) selected="" @elseif(!empty($product_data['category_id']) && $product_data['category_id']==$subcategory['id']) selected="" @endif>&nbsp;&#8594;&#8594;&#8594;{{ $subcategory['title'] }}</option>
            @endforeach
            @endforeach
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="category_id">Brand</label> <span class="text-danger">*</span>
        <select name="brand_id" id="brand_id" class="form-control {{ $errors->has('brand_id') ? 'is-invalid' : '' }}">
            <option value="">Select</option>
            @foreach ( $brands as $brand )
            <option value="{{ $brand['id'] }}" @if($brand['id'] == $product_data['brand_id']): selected @else ' ' @endif>{{ $brand['title'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="title">Product name</label><span class="text-danger">*</span>
        <input type="text" value="{{ old('title', $product_data['title']) }}" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" placeh@older="Product name">
    </div>
    <div class="form-group col-md-4">
        <label for="code">Code</label><span class="text-danger">*</span>
        <input type="text" value="{{ @old('code', $product_data['code']) }}" name="code" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" id="code" placeh@older="Enter Product Code">
    </div>
    <div class="form-group col-md-4">
        <label for="color">Color</label><span class="text-danger">*</span>
        <input type="text" value="{{ @old('color', $product_data['color']) }}" name="color" class="form-control {{ $errors->has('color') ? 'is-invalid' : '' }}" id="color" placeh@older="Enter Product Color">
    </div>
    <div class="form-group col-md-4">
        <label for="price">Price</label><span class="text-danger">*</span>
        <input type="text" value="{{ @old('price', $product_data['price']) }}" name="price" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" id="price" placeh@older="Enter Product Price">
    </div>
    <div class="form-group col-md-4">
        <label for="weight">Weight</label><span class="text-danger">*</span>
        <input type="text" value="{{ @old('weight', $product_data['weight']) }}" name="weight" class="form-control" id="weight" placeh@older="Enter Product Weight">
    </div>
    <div class="form-group col-md-4">
        <label for="discount_amt">Discount</label><span class="text-danger">*</span>(%)
        <input type="text" name="discount_amt" class="form-control" placeh@older="Category discount" value="{{ @old('discount_amt', $product_data['discount_amt']) }}">
    </div>
    <div class="col-md-4" style="margin-top: 30px;">
        <div class="custom-file">
            <label class="custom-file-label" for="customFile">Product image</label>
            <input type="file" class="custom-file-input" id="customFile" name="image">
        </div>
    </div>
    <div class="form-group col-md-4">
        <label for="fabric">Fabric</label> <span class="text-danger">*</span>
        <select name="fabric" class="form-control {{ $errors->has('fabric') ? 'is-invalid' : '' }}" id="fabric">
            <option>Select fabric</option>
            @foreach ($fabrics as $fabric)
            <option value={{ $fabric }} @if (!empty($product_data['fabric']) && $product_data['fabric']==$fabric) selected @endif>{{ $fabric }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="pattern">Pattern</label> <span class="text-danger">*</span>
        <select name="pattern" class="form-control {{ $errors->has('pattern') ? 'is-invalid' : '' }}" id="pattern">
            <option>Select pattern</option>
            @foreach ($patterns as $item)
            <option value={{ $item }} @if (!empty($product_data['pattern']) && $product_data['pattern']==$item) selected @endif>{{ $item }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="sleeve">Sleeve</label> <span class="text-danger">*</span>
        <select name="sleeve" class="form-control {{ $errors->has('sleeve') ? 'is-invalid' : '' }}" id="sleeve">
            <option>Select sleeve</option>
            @foreach ($sleeves as $sleeve)
            <option value={{ $sleeve }} @if (!empty($product_data['sleeve']) && $product_data['sleeve']==$sleeve) selected @endif>{{ $sleeve }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="fit">Fit</label> <span class="text-danger">*</span>
        <select name="fit" class="form-control {{ $errors->has('fit') ? 'is-invalid' : '' }}" id="fit">
            <option>Select fit</option>
            @foreach ($fits as $fit)
            <option value={{ $fit }} @if (!empty($product_data['fit']) && $product_data['fit']==$fit) selected @endif>{{ $fit }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="occasion">Occasion</label> <span class="text-danger">*</span>
        <select name="occasion" class="form-control {{ $errors->has('occasion') ? 'is-invalid' : '' }}" id="occasion">
            <option>Select Occasion</option>
            @foreach ($occasions as $occasion)
            <option value={{ $occasion }} @if (!empty($product_data['occasion']) && $product_data['occasion']==$occasion) selected @endif>{{ $occasion }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-md-4">
			<label for="group_code">Group Code</label> <span class="text-danger">*</span>
			<input type="text" class="form-control" name="group_code" placeholder="Product group code">
		</div>
    <div class="form-group col-md-6">
        <label for="meta_title">Meta title</label><span class="text-danger">*</span>
        <input type="text" value="{{ @old('meta_title', $product_data['meta_title']) }}" name="meta_title" class="form-control {{ $errors->has('meta_title') ? 'is-invalid' : '' }}" id="meta_title" placeh@older="Product meta title">
    </div>
    <div class="form-group col-md-6">
        <label for="description">Description</label><span class="text-danger">*</span>
        <textarea placeholder="Description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" rows="3">{{ old('description', $product_data['description']) }}</textarea>
    </div>
    <div class="form-group col-md-6">
        <label for="wash_care">Wash care</label><span class="text-danger">*</span>
        <textarea placeholder="wash care" class="form-control {{ $errors->has('wash_care') ? 'is-invalid' : '' }}" name="wash_care" rows="3">{{ old('wash_care', $product_data['wash_care']) }}</textarea>
    </div>
    <div class="form-group col-md-6">
        <label for="meta_description">Meta description</label><span class="text-danger">*</span>
        <textarea placeholder="meta description" class="form-control {{ $errors->has('meta_description') ? 'is-invalid' : '' }}" name="meta_description" rows="3">{{ old('meta_description', $product_data['meta_description']) }}</textarea>
    </div>
    <div class="form-group col-md-6">
        <label for="meta_keyword">Meta keyword</label><span class="text-danger">*</span>
        <textarea placeholder="meta keyword" class="form-control {{ $errors->has('meta_keyword') ? 'is-invalid' : '' }}" name="meta_keyword" rows="3">{{ old('meta_keyword', $product_data['meta_keyword']) }}</textarea>
    </div>
    <div class="form-group col-md-4">
        <label for="status">Status</label> <span class="text-danger">*</span>
        <select name="status" class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" id="status">
            <option>Select status</option>
            <option value="1" {{( $product_data['status'] == "1" )? "selected": " "}}>Active</option>
            <option value="0" {{( $product_data['status'] == "0" )? "selected": " "}}>In Active</option>
        </select>
    </div>
    <div class="form-check  mt-4">
        <label class="form-check-label" for="is_featured">Is Featured ?</label>
        <input type="checkbox" class="ml-2 form-check-input" id="is_featured" name="is_featured" value="Yes" @if (!empty($product_data['is_featured']) && $product_data['is_featured']=="Yes" ) checked @endif>
    </div>
</div>
<button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
@section('scripts')
<!-- bs-custom-file-input -->
<script src="{{ URL::asset('backend')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script type="text/javascript">
    //Jquery ready function
    $(document).ready(function() {
        bsCustomFileInput.init();
    });
</script>
@endsection
