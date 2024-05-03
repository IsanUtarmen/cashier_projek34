@extends('template/layout1')

@push('style')
@endpush

@section('content')

<div class="x_content">
    <div class="table-responsive">
        <table class="table table-compact table stripped" id="tbl-pelanggan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No Tlp</th>
                    <th>Alamat</th>
                    <th>Tools</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($pelanggan  as $p)
            <tr>
                <td>{{ $i = !isset ($i) ? ($i = 1) : ++$i }}</td>
                <td>{{ $p->nama_pelanggan }}</td>
                <td>{{ $p->email }}</td>
                <td>{{ $p->no_telp }}</td>
                <td>{{ $p->alamat }}</td>
                <td> <button class="pilihBarangBtn">Pilih</button></td></td>
            </tr>
        @endforeach
    </tbody>
        </table>
    </div>
</div>