@csrf
<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label for="coupon_option">Coupon option</label> <br>
            <span>
                <input value="automatic" type="radio" name="coupon_option"
                    id="automaticCoupon" checked>&nbsp;Automatic&nbsp;&nbsp;
            </span>
            <span>
                <input value="manual" type="radio" name="coupon_option" id="manualCoupon"> &nbsp;Manual&nbsp;&nbsp;
            </span>
        </div>
        @if ($errors->has('coupon_option'))
            <span class="alert alert-danger">
                <strong>{{ $errors->first('coupon_option') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="coupon_type">Coupon type</label> <br>
            <span>
                <input value="multipleTimes" type="radio" name="coupon_type" id="multipleTimes">&nbsp;Multiple
                Times&nbsp;
            </span>
            <span>
                <input value="singleTimes" type="radio" name="coupon_type" id="singleTimes" checked> &nbsp;Single Times&nbsp;
            </span>
        </div>

        @if ($errors->has('coupon_type'))
            <span class="alert alert-danger">
                <strong>{{ $errors->first('coupon_type') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="amount_type">Amount type</label> <br>
            <span>
                <input value="percentage" type="radio" name="amount_type" id="percentage">&nbsp;Percentage (In
                %)&nbsp;&nbsp;
            </span>
            <span>
                <input value="fixed" type="radio" name="amount_type" id="fixed" checked> &nbsp;Fixed (In BDT.)&nbsp;&nbsp;
            </span>
        </div>
        @if ($errors->has('amount_type'))
            <span class="alert alert-danger">
                <strong>{{ $errors->first('amount_type') }}</strong>
            </span>
        @endif
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
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter amount" required>
        </div>
        @if ($errors->has('amount'))
            <span class="alert alert-danger">
                <strong>{{ $errors->first('amount') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="expiry_date">Expiry Date</label>
            <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                <input name="expiry_date" type="text" class="form-control datetimepicker-input"
                    data-target="#datetimepicker4" placeholder="Click on icon to select date" required />
                <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
        @if ($errors->has('expiry_date'))
            <span class="alert alert-danger">
                <strong>{{ $errors->first('expiry_date') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="categories">Select Categories</label>
            <select name="categories[]" id="categories" class="select2bs4" multiple="multiple"
                data-placeholder="Select Categories" style="width: 100%;" required>
                <option value="">Select Categories</option>
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
        @if ($errors->has('categories'))
            <span class="alert alert-danger">
                <strong>{{ $errors->first('categories') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>Select Users Emails</label>
            <select name="users[]" id="users" class="select2bs4" multiple="multiple" data-placeholder="Select Emails"
                style="width: 100%;" required>
                <option value="">Select Emails</option>
                @foreach ($users as $user)
                    <option value="{{ $user['email'] }}">{{ $user['email'] }}</option>
                @endforeach
            </select>
        </div>

        @if ($errors->has('users'))
            <span class="alert alert-danger">
                <strong>{{ $errors->first('users') }}</strong>
            </span>
        @endif
    </div>
</div>
<button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
