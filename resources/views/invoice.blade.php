<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f3f3;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #FFC43F;
            padding-bottom: 10px;
        }
        .header .logo {
            font-size: 28px;
            font-weight: bold;
            color: #FFC43F;
        }
        .header .company-info {
            text-align: right;
            font-size: 14px;
            color: #555;
        }
        .invoice-title {
            text-align: center;
            font-size: 30px;
            font-weight: bold;
            color: #444;
            margin: 20px 0;
        }
        .details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .details div {
            width: 48%;
        }
        .details h4 {
            margin-bottom: 8px;
            font-size: 16px;
            font-weight: bold;
            color: #FFC43F;
        }
        .details p {
            margin: 4px 0;
            font-size: 14px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #FFC43F;
            color: #fff;
            font-size: 14px;
        }
        table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }
        .totals {
            margin-top: 20px;
            font-size: 16px;
            text-align: right;
        }
        .totals .amount {
            font-weight: bold;
            color: #FFC43F;
        }
        .footer {
            background-color: #FFC43F;
            color: #fff;
            padding: 20px 30px;
            text-align: center;
            font-size: 14px;
            margin-top: 30px;
            border-top: 1px solid #ddd;
        }
        .footer p {
            margin: 5px 0;
        }
        .footer a {
            color: #fff;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">IMS</div>
            <div class="company-info">
                <p><strong>Arundel building</strong></p>
                <p>30 Brown ln, Sheffield City Centre,</p>
                <p>Sheffield,s1 2NH</p>
                <p>Phone: +44 7585 962894</p>
            </div>
        </div>

        <!-- Invoice Title -->
        <div class="invoice-title">INVOICE</div>

        <!-- Details -->
        <div class="details">
            <div class="bill-to">
                <h4>BILL TO:</h4>
                <p><strong>Sales team</strong></p>
                <p>Sheffield</p>
                <p>Email: Sales@ims.co.uk</p>
                <p>Phone: +44 7585 962894</p>
            </div>
            <div class="invoice-info">
                <h4>Invoice Details:</h4>
                <p><strong>Invoice Number:</strong> {{ $orderDetails->order_number }}</p>
                <p><strong>Invoice Date:</strong> {{ \Carbon\Carbon::parse($orderDetails->created_at)->format('Y-m-d') }}</p>
                <p><strong>Payment Due:</strong> Upon receipt</p>
                <p><strong>Amount Due :</strong> £{{ number_format($orderDetails->total_amount, 2) }}</p>
            </div>
        </div>

        <!-- Table -->
        <table>
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <!-- Calculate Total -->
            <?php $total = 0; ?>
            <tbody>
                @foreach ($orderItems as $item)
                <?php $total += $item->total_price; ?>
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>£{{ number_format($item->price, 2) }}</td>
                    <td>£{{ number_format($item->total_price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="totals">
            <p class="amount"><strong>Total:</strong> £{{ number_format($total, 2) }}</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Thank you for your business!</strong></p>
            <p>If you have any questions, contact us at <a href="mailto:ramzan@gmail.com">Sales@ims.co.uk</a>.</p>
            <p>Visit us at: <a href="#">www.ims.com</a></p>
        </div>
    </div>
</body>
</html>
