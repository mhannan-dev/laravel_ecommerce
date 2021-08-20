@csrf
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="coupon_code">Coupon option</label> <br>
        <label class="radio-inline">
            <input type="radio" name="coupon_option"> &nbsp; Automatic &nbsp;
        </label>
        <label class="radio-inline">
            <input type="radio" name="coupon_option">&nbsp; Mannual &nbsp;
        </label>

    </div>
    <div class="form-group col-md-6">
        <label for="coupon_code">Coupon code</label>
        <input type="text" name="coupon_code" class="form-control " id="coupon_code" placeholder="Coupon code">
    </div>
    <div class="form-group col-md-6">
        <label for="title">Coupon title</label>
        <input type="text" name="title" class="form-control " id="title" placeholder="Coupon title">
    </div>
    <div class="form-group col-md-6">
        <label for="alt_text">Coupon alternate text</label>
        <input type="text" name="alt_text" class="form-control" id="alt_text" placeholder="Coupon Alternate Text">
    </div>
</div>
<button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
@section('scripts')
    <script type="text/javascript">

    </script>
@endsection
