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
    //Hiding flash message
    $('#msgDiv').delay(1500).hide(500);
    //Showing courier name and tracking number
    $("#courier_name").hide();
    $("#tracking_number").hide();
    $("#order_status").on("change",function(){
        if (this.value = "Shipped") {
            $("#courier_name").show();
            $("#tracking_number").show();
        } else {
            $("#courier_name").hide();
            $("#tracking_number").hide();
        }
    });
});
