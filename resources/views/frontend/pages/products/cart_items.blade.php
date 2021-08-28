<?php
use App\Models\Product;
?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Product</th>
            <th>Description</th>
            <th>Quantity/Update</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sub_total_price = 0;
        $total_discount = 0;
        $total_price = 0;
        ?>
        @foreach ($userCartItems as $item)
            <?php
            $attrPrice = Product::getDiscountedAttrPrice($item['product_id'], $item['size']);
            //dd($attrPrice);
            ?>
            <tr>
                <td>
                    <img style="width: 60px;"
                        src="{{ asset('uploads/product_img_small/' . $item['product']['image']) }}" alt="">
                </td>
                <td>
                    {{ $item['product']['title'] }} <strong> ({{ $item['product']['code'] }}) </strong> <br />
                    Color : {{ $item['product']['color'] }} <br />
                    Size : {{ $item['size'] }}
                </td>
                <td>
                    <div class="input-append">
                        <input class="span1" style="max-width:34px" value="{{ $item['quantity'] }}"
                            id="appendedInputButtons" size="16" type="text">
                        <button class="btn btnItemUpdate qtyMinus" data-cart_id={{ $item['id'] }} type="button"><i
                                class="icon-minus"></i></button>
                        <button class="btn btnItemUpdate qtyPlus" data-cart_id={{ $item['id'] }} type="button"><i
                                class="icon-plus"></i></button>
                        <button class="btn btn-danger btnItemDelete" data-cart_id={{ $item['id'] }} type="button"><i
                                class="icon-remove icon-white"></i></button>
                    </div>
                </td>
                <td style="text-align:right;">BDT. {{ number_format($attrPrice['price'], 2) }}</td>
                <td style="text-align:right;">BDT. {{ number_format($attrPrice['discount'], 2) }}</td>
                <td style="text-align:right;">BDT. {{ number_format($attrPrice['final_price'] * $item['quantity'], 2) }}</td>
            </tr>
            <?php
            $sub_total_price = $sub_total_price + $attrPrice['final_price'] * $item['quantity'];
            $total_discount = $total_discount + $attrPrice['discount'];
            $total_price = $sub_total_price - $total_discount;
            ?>
        @endforeach
        <tr>
            <td colspan="5" style="text-align:right">Sub Total Price: </td>
            <td style="text-align:right;"> BDT. {{ number_format($sub_total_price, 2) }}</td>
        </tr>
        <tr>
            <td colspan="5" style="text-align:right">Coupon Discount: </td>
            <td class="couponAmount" style="text-align:right;">
                @if (Session::has('couponAmount'))
                    -BDT. {{ Session::get('couponAmount') }}
                @else
                    BDT. 0
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="5" style="text-align:right"><strong>GRAND TOTAL =</strong></td>
            <td class="label label-important grand_total" style="display:block;text-align:right"> <strong> BDT.
                    {{ number_format($total_price - Session::get('couponAmount'), 2) }}
            </td>
        </tr>
    </tbody>
</table>
