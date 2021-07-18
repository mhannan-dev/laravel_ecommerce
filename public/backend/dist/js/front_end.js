$(function () {
    //X-CSRF-TOKEN
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#sort').on('change', function () {
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
                $('.filter_products_ajax').html(data);
            }
        });
    });
    //Fabric filter
    $('.fabric').on('click', function () {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var occasion = get_filter('occasion');
        var fit = get_filter('fit');
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
                $('.filter_products_ajax').html(data);
            }
        });
    });
    //Fabric filter
    $('.sleeve').on('click', function () {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var occasion = get_filter('occasion');
        var fit = get_filter('fit');
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
                $('.filter_products_ajax').html(data);
            }
        });
    });


    //Pattern filter
    $('.pattern').on('click', function () {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var occasion = get_filter('occasion');
        var fit = get_filter('fit');
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
                $('.filter_products_ajax').html(data);
            }
        });
    });

    //Occasions Filter
    $('.occasion').on('click', function () {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var occasion = get_filter('occasion');
        var fit = get_filter('fit');
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
                $('.filter_products_ajax').html(data);
            }
        });
    });

    //Fit Filter
    $('.fit').on('click', function () {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var occasion = get_filter('occasion');
        var fit = get_filter('fit');
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
                $('.filter_products_ajax').html(data);
            }
        });
    });

    function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ':checked').each(function () {
            filter.push($(this).val());
        });
        return filter;
    }

    //getPrice
   $("#getPrice").on('change', function(){
        var size = $(this).find(":selected").text();
        var product_id    =  $(this).attr("product_id");
        $.ajax({
            type: 'POST',
            url: '/get-product-price',
            data: { size: size, product_id: product_id },
            success: function (resp) {
                //alert(resp);
                $('.getAttrPrice').html("BDT. "+resp);
            },
            error: function () {
                alert("Error")
            }

        });
    });

});
