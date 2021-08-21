@csrf
<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label for="coupon_code">Coupon option</label> <br>
            <span>
                <input type="radio" name="coupon_option" id="automaticCoupon">&nbsp;Automatic&nbsp;&nbsp;
            </span>
            <span>
                <input type="radio" name="coupon_option" id="manualCoupon"> &nbsp;Manual&nbsp;&nbsp;
            </span>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="coupon_type">Coupon type</label> <br>
            <span>
                <input type="radio" name="coupon_type" id="multipleTimes">&nbsp;Multiple Times&nbsp;
            </span>
            <span>
                <input type="radio" name="coupon_type" id="singleTimes"> &nbsp;Single Times&nbsp;
            </span>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="amount_type">Amount type</label> <br>
            <span>
                <input type="radio" name="amount_type" id="percentage">&nbsp;Percentage (In %)&nbsp;&nbsp;
            </span>
            <span>
                <input type="radio" name="amount_type" id="fixed"> &nbsp;Fixed (In BDT.)&nbsp;&nbsp;
            </span>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group" id="couponField" style="display: none">
            <label for="coupon_code">Coupon code</label>
            <input type="text" name="coupon_code" class="form-control " id="coupon_code" placeholder="Coupon code">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <label for="caregories">Amount</label>
        <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter amount">
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="caregories">Categores</label>
            <select name="caregories[]" id="caregories" class="select2bs4" multiple="multiple"
                data-placeholder="Select a State" style="width: 100%;">
                <option value="">Select</option>
                @foreach ($categories as $section)
                    <optgroup label="{{ $section['title'] }}"></optgroup>
                    @foreach ($section['categories'] as $category)
                        <option value="{{ $category['id'] }}" @if (!empty(@old('category_id')) && $category['id'] == @old('category_id')) selected="" @elseif(!empty($product_data['category_id']) && $product_data['category_id']==$category['id']) selected @endif>&nbsp;&#8594;&#8594;{{ $category['title'] }}</option>
                        @foreach ($category['subcategories'] as $subcategory)
                            &#8594;&#8594;&#8594;<option value="{{ $subcategory['id'] }}" @if (!empty(@old('category_id')) && $subcategory['id'] == @old('category_id')) selected="" @elseif(!empty($product_data['category_id']) && $product_data['category_id']==$subcategory['id']) selected="" @endif>&nbsp;&#8594;&#8594;&#8594;{{ $subcategory['title'] }}</option>
                        @endforeach
                    @endforeach
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label>Users</label>
            <select name="users[]" id="users" class="select2bs4" multiple="multiple" data-placeholder="Select a State"
                style="width: 100%;">
                <option>Select users</option>
                @foreach ($users as $user)
                    <option>{{ $user['email'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label>Expiry Date</label>
            <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" />
                <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
<button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
