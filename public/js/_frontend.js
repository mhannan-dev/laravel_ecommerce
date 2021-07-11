$(function () {
    $('#sort_products').on('change', function () {
        var sort_products = $(this).val();
        var slug = $("#slug").val();
        $.ajax({
            url: slug,
            method: "post",
            data: {sort_products:sort_products, url:slug},
            success: function (data) {
                 $('.filter_products_ajax').html(data);
            }
        });
    });
    //Fabric filter
    $('.fabric').on('click', function () {
        var fabric = get_filter(this);
        var  sort_products = $("#sort_products option:selected").text();
        var slug = $("#slug").val();
        $.ajax({
            url: slug,
            method: "post",
            data: {fabric: fabric, sort_products:sort_products, url:slug },
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
