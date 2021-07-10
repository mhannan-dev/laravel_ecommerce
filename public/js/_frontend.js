// $(function() {
//    $('#sort_products').on('change', function(){
//         this.form.submit();
//    });
//   });
$(function () {
    $('#sort_products').on('change', function () {
        var sort_product = $(this).val();
        var slug = $("#slug").val();
        $.ajax({
            url: slug,
            method: "POST",
            data: {sort_products:sort_products, url:slug},
            success:function(data){
                $('.filter_products_ajax').html(data);
            }
        });
    });
});
