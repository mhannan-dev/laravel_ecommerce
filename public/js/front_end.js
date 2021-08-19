$(function () {
    //X-CSRF-TOKEN
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    $("#sort").on("change", function () {
        var sort = $(this).val();
        var slug = $("#slug").val();
        $.ajax({
            url: slug,
            method: "post",
            data: {
                sort: sort,
                url: slug
            },
            success: function (data) {
                $(".filter_products_ajax").html(data);
            }
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
                url: slug
            },
            success: function (data) {
                $(".filter_products_ajax").html(data);
            }
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
                url: slug
            },
            success: function (data) {
                $(".filter_products_ajax").html(data);
            }
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
                url: slug
            },
            success: function (data) {
                $(".filter_products_ajax").html(data);
            }
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
                url: slug
            },
            success: function (data) {
                $(".filter_products_ajax").html(data);
            }
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
                url: slug
            },
            success: function (data) {
                $(".filter_products_ajax").html(data);
            }
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
        var size = $(this)
            .find(":selected")
            .text();
        var product_id = $(this).attr("product_id");
        $.ajax({
            type: "POST",
            url: "/get-product-price",
            data: {
                size: size,
                product_id: product_id
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
            }
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
                cart_id: cartId
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
            }
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
                    cart_id: cartId
                },
                success: function (resp) {
                    //alert(resp.status);
                    $(".totalCartItems").html(resp.totalCartItems);
                    $("#AppendCartItems").html(resp.view);
                },
                error: function () {
                    alert("Error");
                }
            });
        }
    });

});
