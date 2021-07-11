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
    function get_filter(class_name) {
        var filter = [];
         $('.' +class_name+':checked').each(function () {
                filter.push($(this).val());
         });
         return filter;

    }
});
