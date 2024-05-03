<!DOCTYPE html>
<html>

<head>
    <style>
        #absensi {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #absensi td,
        #absensi th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #absensi tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #absensi tr:hover {
            background-color: #ddd;
        }

        #absensi th {
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

    <h1>Data Absensi</h1>
    <table id="absensi">
        <tr>
            <th>Nama Karyawan</th>
            <th>Tanggal Masuk</th>
            <th>Waktu Masuk</th>
            <th>Status</th>
            <th>Waktu Keluar</th>

        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($absensi as $p)
            <tr>
                <td>{{ $p->namaKaryawan }}</td>
                <td>{{ $p->tanggalMasuk }}</td>
                <td>{{ $p->waktuMasuk }}</td>
                <td>{{ $p->status}}</td>
                <td>{{ $p->waktuKeluar}}</td>
            </tr>
        @endforeach
    </table>

</body>

</html>
