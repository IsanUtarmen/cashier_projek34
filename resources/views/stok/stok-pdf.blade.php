<!DOCTYPE html>
<html>

<head>
    <style>
        #stok {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #stok td,
        #stok th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #stok tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #stok tr:hover {
            background-color: #ddd;
        }

        #stok th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #533ddf;
            color: white;
            text-align: center;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>

<body>

    <h1>Data stok</h1>
    <table id="stok">
        <tr>
            <th>Menu Id</th>
            <th>Jumlah</th>


        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($stok as $p)
            <tr>
                <td>{{ $p->menu_id }}</td>
                <td>{{ $p->jumlah }}</td>

            </tr>
        @endforeach
    </table>

</body>

</html>
