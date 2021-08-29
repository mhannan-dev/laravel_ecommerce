$(function () {
    //X-CSRF-TOKEN
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $("#sort").on("change", function () {
        var sort = $(this).val();
        var slug = $("#slug").val();
        $.ajax({
            url: slug,
            method: "post",
            data: {
                sort: sort,
                url: slug,
            },
            success: function (data) {
                $(".filter_products_ajax").html(data);
            },
        });
    });
    //Fabric filter
    $(".fabric").on("click", function () {
        var fabric = get_filter("fabric");
        var sleeve = get_filter("sleeve");
        var pattern = get_filter("pattern");
        var occasion = get_filter("occasion");
        var fit = get_filter("fit");
        var sort = $("#sort option:selected").text();
        var slug = $("#slug").val();
        $.ajax({
            url: slug,
            method: "post",
            data: {
                fabric: fabric,
                sleeve: sleeve,
                pattern: pattern,
                occasion: occasion,
                fit: fit,
                sort: sort,
                url: slug,
            },
            success: function (data) {
                $(".filter_products_ajax").html(data);
            },
        });
    });
    //Fabric filter
    $(".sleeve").on("click", function () {
        var fabric = get_filter("fabric");
        var sleeve = get_filter("sleeve");
        var pattern = get_filter("pattern");
        var occasion = get_filter("occasion");
        var fit = get_filter("fit");
        var sort = $("#sort option:selected").text();
        var slug = $("#slug").val();
        //console.log(sleeve);
        $.ajax({
            url: slug,
            method: "post",
            data: {
                fabric: fabric,
                sleeve: sleeve,
                pattern: pattern,
                occasion: occasion,
                fit: fit,
                sort: sort,
                url: slug,
            },
            success: function (data) {
                $(".filter_products_ajax").html(data);
            },
        });
    });
    //Pattern filter
    $(".pattern").on("click", function () {
        var fabric = get_filter("fabric");
        var sleeve = get_filter("sleeve");
        var pattern = get_filter("pattern");
        var occasion = get_filter("occasion");
        var fit = get_filter("fit");
        var sort = $("#sort option:selected").text();
        var slug = $("#slug").val();
        //console.log(pattern);
        $.ajax({
            url: slug,
            method: "post",
            data: {
                fabric: fabric,
                sleeve: sleeve,
                pattern: pattern,
                occasion: occasion,
                fit: fit,
                sort: sort,
                url: slug,
            },
            success: function (data) {
                $(".filter_products_ajax").html(data);
            },
        });
    });
    //Occasions Filter
    $(".occasion").on("click", function () {
        var fabric = get_filter("fabric");
        var sleeve = get_filter("sleeve");
        var pattern = get_filter("pattern");
        var occasion = get_filter("occasion");
        var fit = get_filter("fit");
        var sort = $("#sort option:selected").text();
        var slug = $("#slug").val();
        //console.log(pattern);
        $.ajax({
            url: slug,
            method: "post",
            data: {
                fabric: fabric,
                sleeve: sleeve,
                pattern: pattern,
                occasion: occasion,
                fit: fit,
                sort: sort,
                url: slug,
            },
            success: function (data) {
                $(".filter_products_ajax").html(data);
            },
        });
    });
    //Fit Filter
    $(".fit").on("click", function () {
        var fabric = get_filter("fabric");
        var sleeve = get_filter("sleeve");
        var pattern = get_filter("pattern");
        var occasion = get_filter("occasion");
        var fit = get_filter("fit");
        var sort = $("#sort option:selected").text();
        var slug = $("#slug").val();
        //console.log(pattern);
        $.ajax({
            url: slug,
            method: "post",
            data: {
                fabric: fabric,
                sleeve: sleeve,
                pattern: pattern,
                occasion: occasion,
                fit: fit,
                sort: sort,
                url: slug,
            },
            success: function (data) {
                $(".filter_products_ajax").html(data);
            },
        });
    });
    function get_filter(class_name) {
        var filter = [];
        $("." + class_name + ":checked").each(function () {
            filter.push($(this).val());
        });
        return filter;
    }
    //getPrice
    $("#getPrice").on("change", function () {
        var size = $(this).find(":selected").text();
        var product_id = $(this).attr("product_id");
        $.ajax({
            type: "POST",
            url: "/get-product-price",
            data: {
                size: size,
                product_id: product_id,
            },
            success: function (resp) {
                if (resp["discount"] > 0) {
                    $(".getAttrPrice").html(
                        "<del>BDT." +
                        resp["price"] +
                        "</del> BDT." +
                        resp["final_price"]
                    );
                } else {
                    $(".getAttrPrice").html("BDT." + resp["price"]);
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });
    //Items update using ajax in carts page
    $(document).on("click", ".btnItemUpdate", function () {
        if ($(this).hasClass("qtyMinus")) {
            //If minus button->icon is clicked
            var quantity = $(this).prev().val();
            //alert(quantity);
            if (quantity == 1) {
                alert("Quantity must be 1 or greater!");
                return false;
            } else {
                new_qty = parseInt(quantity) - 1;
            }
        }
        if ($(this).hasClass("qtyPlus")) {
            var quantity = $(this).prev().prev().val();
            new_qty = parseInt(quantity) + 1;
        }
        //alert(new_qty);
        var cartId = $(this).data("cart_id");
        //alert(cartId);
        $.ajax({
            type: "POST",
            url: "/update-cart-item-qty",
            data: {
                qty: new_qty,
                cart_id: cartId,
            },
            success: function (resp) {
                //alert(resp.status);
                if (resp.status == false) {
                    //alert('Produc stock is not available');
                    alert(resp.message);
                }
                $(".totalCartItems").html(resp.totalCartItems);
                $("#AppendCartItems").html(resp.view);
            },
            error: function () {
                alert("Error");
            },
        });
    });
    //Items update using ajax in carts page
    $(document).on("click", ".btnItemDelete", function () {
        var cartId = $(this).data("cart_id");
        var result = confirm("Dou you want to remove this item?");
        if (result) {
            $.ajax({
                type: "POST",
                url: "/delete-cart-item",
                data: {
                    cart_id: cartId,
                },
                success: function (resp) {
                    //alert(resp.status);
                    $(".totalCartItems").html(resp.totalCartItems);
                    $("#AppendCartItems").html(resp.view);
                },
                error: function () {
                    alert("Error");
                },
            });
        }
    });
    // Coupon apply
    //hang on event of form with id=myform
    $("#applyCoupon").submit(function (e) {
        var user = $(this).attr("user");
        if (user == 1) {
            // Code
        } else {
            alert("Please login to apply coupon");
            return false;
        }
        var code = $("#code").val();
        //alert(code);
        $.ajax({
            type: "POST",
            url: "/apply-coupon",
            data: {
                code: code,
            },
            success: function (resp) {
                if (resp.message != "") {
                    alert(resp.message);
                }
                $(".totalCartItems").html(resp.totalCartItems);
                $("#AppendCartItems").html(resp.view);
                if (resp.couponAmount >= 0) {
                    //alert(resp.couponAmount);
                    $(".couponAmount").text("BDT." + resp.couponAmount);
                } else {
                    $(".couponAmount").text("BDT.0");
                }
                if (resp.grand_total >= 0) {
                    //alert(resp.grand_total);
                    $(".grand_total").text("BDT." + resp.grand_total);
                }

            },
            error: function () {
                alert("Error");
            },
        });
    });
});


// Division Section select
function divisionsList() {
    // get value from division lists
    var diviList = document.getElementById('divisions').value;

    // set barishal division districts
    if(diviList == 'Barishal'){
        var disctList = '<option disabled selected>Select District</option><option value="Barguna">Barguna</option><option value="Barishal">Barishal</option><option value="Bhola">Bhola</option><option value="Jhalokati">Jhalokati</option><option value="Patuakhali">Patuakhali</option><option value="Pirojpur">Pirojpur</option>';
    }
    // set Chattogram division districts
    else if(diviList == 'Chattogram') {
        var disctList = '<option disabled selected>Select Division</option><option value="Bandarban">Bandarban</option><option value="Chandpur">Chandpur</option><option value="Chattogram">Chattogram</option><option value="Cumilla">Cumilla</option><option value="Cox\'s Bazar">Cox\'s Bazar</option><option value="Feni">Feni</option><option value="Khagrachhari">Khagrachhari</option><option value="Noakhali">Noakhali</option><option value="Rangamati">Rangamati</option>';
    }
    // set Dhaka division districts
    else if(diviList == 'Dhaka') {
        var disctList = '<option disabled selected>Select Division</option><option value="Dhaka">Dhaka</option><option value="Faridpur">Faridpur</option><option value="Gazipur">Gazipur</option><option value="Gopalganj">Gopalganj</option><option value="Kishoreganj">Kishoreganj</option><option value="Madaripur">Madaripur</option><option value="Manikganj">Manikganj</option><option value="Munshiganj">Munshiganj</option><option value="Narayanganj">Narayanganj</option><option value="Narsingdi">Narsingdi</option><option value="Rajbari">Rajbari</option><option value="Shariatpur">Shariatpur</option><option value="Tangail">Tangail</option>';
    }
    //  set/send districts name to District lists from division
    document.getElementById("distr").innerHTML= disctList;
}

// Thana Section select
function thanaList(){
    var DisList = document.getElementById('distr').value;
    if(DisList == 'Barguna') {
        var thanaList = '<option disabled selected>Select District</option><option value="Barguna">Barguna</option><option value="Barishal">Barishal</option><option value="Bhola">Bhola</option><option value="Jhalokati">Jhalokati</option><option value="Patuakhali">Patuakhali</option><option value="Pirojpur">Pirojpur</option>';
    }
    document.getElementById("polic_sta").innerHTML= thanaList;
}
