<!DOCTYPE html>
<html>
<head>
<style>
    #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #435ebe;
    color: white;
    text-align: center;
    }

    h1{
        text-align: center;
    }
</style>
</head>
<body>

<h1>Data Laporan</h1>
<table id="customers">
<tr>
                    <th>No</th>
                    <th>Id Transaksi</th>
                    <th>Detail Transaksi</th>
                    <th>Total Harga</th>
                </tr>
    @php
        $no = 1;
    @endphp
    @foreach ($transaksi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->id }}</td>
                    <td>
                        @foreach($item->detailTransaksi as $detail)
                        <p>Nama: {{ $detail->menu->nama_menu }}</p>
                        <p>Qty: {{ $detail->jumlah }}</p>
                        <p>Subtotal: {{ $detail->subtotal }}</p>
                        <hr>
                        @endforeach
                    </td>
                    <td>{{ $item->total_harga }}</td>
                </tr>
                @endforeach
</table>

</body>
</html>
