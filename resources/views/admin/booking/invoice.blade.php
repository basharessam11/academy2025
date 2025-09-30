<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>فاتورة</title>
    <style>
        body {
            font-family: 'Amiri', sans-serif;
            direction: rtl;
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
            text-align: right;
        }
    </style>
</head>

<body>
    <h2>فاتورة رقم #{{ $invoice_id }}</h2>
    <p>التاريخ: {{ $date }}</p>
    <p>العميل: {{ $customer_name }}</p>

    <table>
        <thead>
            <tr>
                <th>البند</th>
                <th>الكمية</th>
                <th>السعر</th>
                <th>الإجمالي</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ $item['price'] }}</td>
                    <td>{{ $item['quantity'] * $item['price'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>المبلغ المدفوع: {{ $paid_amount }} ريال</h3>
</body>

</html>
