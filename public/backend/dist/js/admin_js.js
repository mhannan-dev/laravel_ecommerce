$(document).ready(function () {
    //Items update using ajax in carts page
    // $(document).on("click", "#manualCoupon", function () {
    //     $('#couponField').show();
    // });
    // $(document).on("click", "#automaticCoupon", function () {
    //     $('#couponField').hide();
    // });
    $("#manualCoupon").click(function () {
        $('#couponField').show();
    });
    $("#automaticCoupon").click(function () {
        $('#couponField').hide();
    });

});
