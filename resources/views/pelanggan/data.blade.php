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
                <td>
                    <button class="btn text-warning" data-toggle="modal" data-target="#modalFormPelanggan" data-mode="edit"
                        data-id="{{ $p->id }}" data-nama_pelanggan="{{ $p->nama_pelanggan }}" data-email="{{ $p->email }}" data-no_telp="{{ $p->no_telp }}" data-alamat="{{ $p->alamat }}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form method="post" action="{{ route('pelanggan.destroy', $p->id) }}" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn text-danger delete-data" data-nama="{{ $p->nama_pelanggan }}">
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