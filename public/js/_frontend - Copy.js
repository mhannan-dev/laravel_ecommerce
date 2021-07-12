$(function () {
    $('#sort_products').on('change', function () {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var occasion = get_filter('occasion');
        var fit = get_filter('fit');
        var  sort_products = $("#sort_products option:selected").text();
        var slug = $("#slug").val();
        $.ajax({
            url: slug,
            method: "post",
            data: {
                fabric: fabric,
                sleeve:sleeve,
                pattern:pattern,
                occasion:occasion,
                fit:fit,
                sort_products:sort_products,
                url:slug
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
        var  sort_products = $("#sort_products option:selected").text();
        var slug = $("#slug").val();
        $.ajax({
            url: slug,
            method: "post",
            data: {
                fabric: fabric,
                sleeve:sleeve,
                pattern:pattern,
                occasion:occasion,
                fit:fit,
                sort_products:sort_products,
                url:slug
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
        var  sort_products = $("#sort_products option:selected").text();
        var slug = $("#slug").val();
        //console.log(sleeve);
        $.ajax({
            url: slug,
            method: "post",
            data: {
                fabric: fabric,
                sleeve:sleeve,
                pattern:pattern,
                occasion:occasion,
                fit:fit,
                sort_products:sort_products,
                url:slug
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
        var  sort_products = $("#sort_products option:selected").text();
        var slug = $("#slug").val();
        //console.log(pattern);
        $.ajax({
            url: slug,
            method: "post",
            data: {
                fabric: fabric,
                sleeve:sleeve,
                pattern:pattern,
                occasion:occasion,
                fit:fit,
                sort_products:sort_products,
                url:slug
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
        var  sort_products = $("#sort_products option:selected").text();
        var slug = $("#slug").val();
        //console.log(pattern);
        $.ajax({
            url: slug,
            method: "post",
            data: {
                fabric: fabric,
                sleeve:sleeve,
                pattern:pattern,
                occasion:occasion,
                fit:fit,
                sort_products:sort_products,
                url:slug
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
        var  sort_products = $("#sort_products option:selected").text();
        var slug = $("#slug").val();
        //console.log(pattern);
        $.ajax({
            url: slug,
            method: "post",
            data: {
                fabric: fabric,
                sleeve:sleeve,
                pattern:pattern,
                occasion:occasion,
                fit:fit,
                sort_products:sort_products,
                url:slug
            },
            success: function (data) {
                 $('.filter_products_ajax').html(data);
            }
        });
    });

    function get_filter(class_name) {
        var filter = [];
         $('.' +class_name+':checked').each(function () {
                filter.push($(this).val());
         });
         return filter;
    }
});
