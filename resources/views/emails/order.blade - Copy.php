<!DOCTYPE html>
<html>
<title>Order Placed Successfully</title>
<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
    <h2>Your ordered ID <strong>#{{ $orderDetails['id'] }}</strong></h2>
    <table style="width: 700px;">
        <tr>
            <th>Product name</th>
            <th>Code</th>
            <th>Size</th>
            <th>Color</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
        @foreach ($orderDetails['order_products'] as $item)
            <tr>
                <td>{{ $item['product_name'] }}</td>
                <td>{{ $item['product_code'] }}</td>
                <td>{{ $item['product_size'] }}</td>
                <td>{{ $item['product_color'] }}</td>
                <td>{{ $item['product_qty'] }}</td>
                <td>{{ $item['product_price'] }}</td>
            </tr>
        @endforeach
        <tr colspan="5" align="right">
            <td>Shipping Charges</td>
            <td>BDT. {{ $orderDetails['shipping_charges'] }}</td>
        </tr>
        <tr colspan="5" align="right">
            <td>Coupon Amount</td>
            <td>BDT. {{ $orderDetails['coupon_amount'] }}</td>
        </tr>
        <tr colspan="5" align="right">
            <td>Grand Total</td>
            <td>BDT. {{ $orderDetails['grand_total'] }}</td>
        </tr>
    </table>
</body>
</html>
