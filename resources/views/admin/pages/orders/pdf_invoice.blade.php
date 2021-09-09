<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice PDF</title>
    <style>
        #invoice {
            padding: 25px;
        }

        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px
        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #3989c6
        }

        .invoice .company-details {
            text-align: right
        }

        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .contacts {
            margin-bottom: 20px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #3989c6;
            font-size: 1.5rem;
        }

        .invoice main {
            padding-bottom: 50px
        }

        .invoice main .thanks {
            margin-top: -100px;
            font-size: 1.5em;
            margin-bottom: 50px;
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #3989c6
        }

        .invoice main .notices .notice {
            font-size: 1.2em
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px
        }

        .invoice table td,
        .invoice table th {
            padding: 15px;
            background: #eee;
            border-bottom: 1px solid #fff
        }

        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }

        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #3989c6;
            font-size: 1.2em
        }

        .invoice table .qty,
        .invoice table .total,
        .invoice table .unit {
            text-align: right;
            font-size: 1.2em
        }

        .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: #3989c6
        }

        .invoice table .unit {
            background: #ddd
        }

        .invoice table .total {
            background: #3989c6;
            color: #fff
        }

        .invoice table tbody tr:last-child td {
            border: none
        }

        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }

        .invoice table tfoot tr:first-child td {
            border-top: none
        }

        .invoice table tfoot tr:last-child td {
            color: #3989c6;
            font-size: 1.2em;
            border-top: 1px solid #3989c6;
        }

        .invoice table tfoot tr td:first-child {
            border: none
        }

        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }


        @media print {
            .invoice {
                font-size: 11px !important;
                overflow: hidden !important
            }

            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }

            .invoice>div:last-child {
                page-break-before: always
            }
        }

    </style>
</head>

<body>
    <div id="invoice">
        <div class="invoice overflow-auto">
            <div style="min-width: 600px">
                <header>
                    <div class="row">
                        <div class="col">
                            <a target="_blank" href="https://lobianijs.com">
                                <img src="http://lobianijs.com/lobiadmin/version/1.0/ajax/img/logo/lobiadmin-logo-text-64.png"
                                    data-holder-rendered="true" />
                            </a>
                        </div>

                        <div class="col company-details">
                            <h2 class="name">
                                <a target="_blank" href="https://lobianijs.com">
                                    Laravel eCommerce
                                </a>
                            </h2>
                            <div>Mohakhali, Dhaka, Bangladesh</div>
                            <div>(+880) 01744 894 452</div>
                            <div>aa8403997@gmail.com</div>
                        </div>
                    </div>
                </header>
                <main>
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <div class="text-gray-light">INVOICE TO:</div>

                            <h2 class="to">{{ $userDetails['name'] }}</h2>

                            @if (!empty($userDetails['address']) && !empty($userDetails['city']) && !empty($userDetails['country']))
                                <div class="address">{{ $userDetails['address'] }},
                                    {{ $userDetails['city'] }}, {{ $userDetails['country'] }}</div>
                            @endif
                            <div class="email">
                                @if (!empty($userDetails['email']))
                                    <a href="#">{{ $userDetails['email'] }}</a>
                                @endif
                            </div>
                        </div>
                        <div class="col invoice-details">

                            <h1 class="invoice-id">INVOICE #1000{{ $orderDetails['id'] }}</h1>
                            
                            <div class="invoice-date">
                                <div class="date">Date of Invoice: {{ date('Y-m-d') }}</div>
                                <div class="date">Due Date:
                                    {{ date('Y-m-d', strtotime($orderDetails['created_at'])) }}</div>
                                <div class="date">Payment Method:
                                    <strong>{{ $orderDetails['payment_method'] }}</strong></div>
                            </div>
                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">Product Information</th>
                                <th class="text-right">Price</th>
                                <th class="text-right">Qty</th>
                                <th class="text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $subTotal = 0; @endphp
                            @foreach ($orderDetails['order_products'] as $key => $product)
                                <tr>
                                    <td class="no">{{ $loop->index + 1 }}</td>
                                    <td class="text-left unit">
                                        <p> Code: {{ $product['product_code'] }}
                                        - Color: {{ $product['product_color'] }} - Size:
                                        {{ $product['product_size'] }}
                                    </td>

                                    <td class="unit">{{ $product['product_price'] }}</td>
                                    <td class="qty">{{ $product['product_qty'] }}</td>
                                    <td class="total">
                                        {{ $product['product_price'] * $product['product_qty'] }}</td>
                                </tr>
                                @php $subTotal = $subTotal + ($product['product_price'] *  $product['product_qty']) @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">SUBTOTAL</td>
                                <td>BDT. {{ $subTotal }}</td>
                            </tr>
                            @if ($orderDetails['coupon_amount'] > 0)
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">COUPON DISCOUNT</td>
                                    <td>BDT.
                                        {{ $orderDetails['coupon_amount'] }}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">GRAND TOTAL</td>
                                <td>BDT. {{ $orderDetails['grand_total'] }}</td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="thanks">Thank you!</div>
                </main>
                <footer>
                    Invoice was created on a computer and is valid without the signature and seal.
                </footer>
            </div>
            <div></div>
        </div>
    </div>
</body>

</html>
