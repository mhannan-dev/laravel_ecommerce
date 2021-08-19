<div class="form-group">
    <label for="parent_id">Category Level</label> <span class="text-danger">*</span>
    <select name="parent_id" class="form-control {{ $errors->has('parent_id') ? 'is-invalid' : '' }}" name="type">


        <option value="0" @if(isset($category_data['parent_id']) && $category_data['parent_id']==0) selected="" @endif>Main
            Category</option>

            @if(!empty($getCategories))
        @foreach ($getCategories as $category)

        <option value="{{ $category['id'] }}" @if (isset($category_data['parent_id']) && $category_data['parent_id']==$category['id']) selected="" ) @endif>{{ $category['title'] }}
        </option>
        @if (!empty($category['subcategories']))
        @foreach ($category['subcategories'] as $sub_category)
        <option value="{{ $sub_category['id'] }}">
            &nbsp; &#8594;{{ $sub_category['title'] }}
        </option>
        @endforeach
        @endif
        @endforeach
        @endif
    </select>
</div>
