@csrf
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="coupon_code">Coupon option</label> <br>
        <label class="radio-inline">
            <input id="automaticCoupon" type="radio" name="coupon_option"> &nbsp; Automatic &nbsp;
        </label>
        <label class="radio-inline">
            <input id="manualCoupon" type="radio" name="coupon_option">&nbsp; Manual &nbsp;
        </label>
    </div>
    <div class="form-group col-md-6" id="couponField" style="display: none">
        <label for="coupon_code">Coupon code</label>
        <input type="text" name="coupon_code" class="form-control " id="coupon_code" placeholder="Coupon code">
    </div>
</div>
<button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
@section('scripts')
    <script type="text/javascript">
    </script>
@endsection
