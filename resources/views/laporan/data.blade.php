<div class="x_content">
    <div class="table-responsive">
        @if ($transaksi->isEmpty())
            <p>Tidak ada data transaksi.</p>
        @else
            <table class="table table-compact table-striped" id="tbl-laporan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id Transaksi</th>
                        <th>Detail Transaksi</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
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
                </tbody>
            </table>
        @endif
    </div>
</div>
