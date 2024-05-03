<div class="x_content">
    <div class="table-responsive">
        <table class="table table-compact table-striped" id="tbl-titipan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Nama Suplier</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stock</th>
                    <th>Keterangan</th>
                    <th>Tools</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produk_titipan as $produk)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $produk->nama_produk }}</td>
                        <td>{{ $produk->nama_suplier }}</td>
                        <td>{{ $produk->harga_beli }}</td>
                        <td>{{ $produk->harga_jual }}</td>
                        <td>{{ $produk->stock }}</td>
                        <td>{{ $produk->keterangan }}</td>
                        <td>
                            <button class="btn text-warning" data-toggle="modal" data-target="#modalFormTitipan"
                                data-id="{{ $produk->id }}" data-mode="edit"
                                data-nama_produk="{{ $produk->nama_produk }}"
                                data-nama_suplier="{{ $produk->nama_suplier }}"
                                data-harga_beli="{{ $produk->harga_beli }}"
                                data-harga_jual="{{ $produk->harga_jual }}" data-stock="{{ $produk->stock }}"
                                data-keterangan="{{ $produk->keterangan }}">

                                <i class="fas fa-edit"></i>
                            </button>
                            <form method="post" action="produk_titipan/{{ $produk->id }}" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn text-danger delete-data"
                                    data-nama="{{ $produk->nama_produk }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
