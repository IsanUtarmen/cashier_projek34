<!DOCTYPE html>
<html>

<head>
    <style>
        #jenis {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #jenis td,
        #jenis th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #jenis tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #jenis tr:hover {
            background-color: #ddd;
        }

        #jenis th {
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

    <h1>Data jenis</h1>
    <table id="jenis">
        <tr>
            <th>Nama Jenis</th>


        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($jenis as $p)
            <tr>
                <td>{{ $p->nama_jenis }}</td>

            </tr>
        @endforeach
    </table>

</body>

</html>
