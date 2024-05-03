<!DOCTYPE html>
<html>

<head>
    <style>
        #menu {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #menu td,
        #menu th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #menu tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #menu tr:hover {
            background-color: #ddd;
        }

        #menu th {
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

    <h1>Data menu</h1>
    <table id="menu">
        <tr>
            
            <th>Jenis ID</th>
            <th>Nama Menu</th>
            <th>Harga</th>
            <th>Image</th>
            <th>Deskripsi</th>



        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($menu as $p)
            <tr>

                <td>{{ $p->jenis_id }}</td>
                <td>{{ $p->nama_menu }}</td>
                <td>{{ $p->harga }}</td>
                <td><img width="70" src="data:image/png;base64,{{ $p->imageData }}" alt="{{ $p->name }}"></td>
                <td>{{ $p->deskripsi }}</td>

            </tr>
        @endforeach
    </table>

</body>

</html>
