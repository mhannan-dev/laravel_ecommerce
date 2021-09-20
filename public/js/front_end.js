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
                    $(".couponAmount").text("BDT." + resp.couponAmount);
                    //$(".couponAmount").html("BDT." + resp.couponAmount);
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
    //Calculate shipping charge and update grand totla
    $("input[name=address_id]").bind("change", function (e) {
        var shipping_charges = $(this).attr("shipping_charges");
        //alert(shipping_charges);
        var total_price = $(this).attr("total_price");
        var coupon_amount = $(this).attr("coupon_amount");
        var codZipCodeCount = $(this).attr("codZipCodeCount");
        var prepaidZipCodeCount = $(this).attr("prepaidZipCodeCount");
        //alert(codZipCodeCount);
        if (codZipCodeCount > 0) {
            $(".codMethod").show();
        } else {
            //Hide COD Method
            alert("Cod Payment method is not possible")
            //$(".codMethod").hide();
        }
        if (prepaidZipCodeCount > 0) {
            //Show pre paid method
            $(".prePaidMethod").show();
        } else {
            //Hide pre paid method
            $(".prePaidMethod").hide();
        }
        if (coupon_amount == "") {
            coupon_amount = 0;
        }
        $(".shipping_charges").html("BDT." + shipping_charges);
        var grand_total = parseInt(total_price) + parseInt(shipping_charges) - parseInt(coupon_amount);
        $(".grand_total").html("BDT." + grand_total);
        //alert(grand_total);
    });

    $("#checkZipCode").click(function (e) {
        var zipCode = $("#zipCode").val();

        if (zipCode == "") {
            alert("Please enter your area zip code");
            return false;
        }
        $.ajax({
            type: "POST",
            data: {
                zipCode: zipCode
            },
            url: "/check-zip-code",
            success: function (resp) {
                alert(resp);
            },
            error: function (errorThrown) {
                alert(errorThrown);
            }
        });
    });
});
