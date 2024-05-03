<!DOCTYPE html>
<html>

<head>
    <style>
        #meja {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #meja td,
        #meja th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #meja tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #meja tr:hover {
            background-color: #ddd;
        }

        #meja th {
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

    <h1>Data meja</h1>
    <table id="meja">
        <tr>
            <th>Nama meja</th>


        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($meja as $p)
            <tr>
                <td>{{ $p->nama_meja }}</td>

            </tr>
        @endforeach
    </table>

</body>

</html>
