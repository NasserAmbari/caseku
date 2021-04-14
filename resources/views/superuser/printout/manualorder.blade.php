<!DOCTYPE html>
<html>

<head>
    <title>Print Order</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <center>
        <h5>Custom Case</h5>
        <br>
            Nama : {{ $order->name }}
            <br>
            Alamat : {{ $order->address }}
            <br>
            Kurir : {{ $order->shipping_method }}
            <br>
            Pembayaran : {{ $order->payment_method }}
            <br>
            Sumber : {{ $order->order_source }}
            <br>
            Kontak : {{ $order->contact }}

    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Desain</th>
                <th>Brand Hp</th>
                <th>Tipe HP</th>
                <th>Case HP</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $i=1 
            @endphp
            @foreach($items as $item)
            <tr>
                
                <td>{{ $i++ }}</td>
                <td>
                    <!-- <img src="{{asset('/images/orderitems/'.$item->image)}}" alt=""> -->
                </td>
                <td>{{ $item->phone_brand }}</td>
                <td>{{ $item->phone_type }}</td>
                <td>{{ $item->case_type }}</td>
                <td>{{ $item->amount }}</td>
                <td>{{ $item->price * $item->amount }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4"></td>
                <td>Total</td>
                <td>Masih Bingung</td>

            </tr>
        </tbody>
    </table>

</body>

</html>
