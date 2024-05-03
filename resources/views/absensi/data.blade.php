<div class="x_content">
    <div class="table-responsive">
        <table class="table table-compact table stripped" id="tbl-absensi">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Karyawan</th>
                    <th>Tanggal Masuk</th>
                    <th>Waktu Masuk</th>
                    <th>Status</th>
                    <th>Waktu Keluar</th>
                    <th>Tools</th>
                </tr>
            </thead>
            <tbody>


                @foreach ($absensi as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->namaKaryawan }}</td>
                        <td>{{ $p->tanggalMasuk }}</td>
                        <td>{{ $p->waktuMasuk }}</td>
                        <td>
                            {{ $p->status }}
{{--
                            <select class="form-select status-select"
                                style="width: 120px;
                                    height: 40px;
                                    font-size: 20px; ">
                                <option value="masuk" {{ $p->status === 'masuk' ? 'selected' : '' }}>Masuk</option>
                                <option value="sakit" {{ $p->status === 'sakit' ? 'selected' : '' }}>Sakit</option>
                                <option value="cuti" {{ $p->status === 'cuti' ? 'selected' : '' }}>Cuti</option>
                            </select> --}}
                        </td>

                        <td>
                            @php
                            // Pisahkan jam dan menit dari waktu keluar
                            $jamKeluar = explode(':', $p->waktuKeluar)[0];
                            $menitKeluar = explode(':', $p->waktuKeluar)[1];

                            // A;bil jam saat ini

                            $jamSaatIni = (float) (date('H') + 7 . '.' . date('i'));
                            $jamSaatKeluarAh =
                                (float) ($jamKeluar . '.' . $menitKeluar);

                            // dd($jamSaatIni, $jamSaatKeluarah);
                            // Jika jam keluar sama dengan jam saat ini, tampilkan "Selesai"
                            // Jika tidak, tampilkan waktu keluar
                            if ($jamSaatKeluarAh <= $jamSaatIni) {
                                echo 'Selesai';
                            } else {
                                echo $p->waktuKeluar;
                            }
                        @endphp
                        </td>

                        <script>
                            function tampilkanWaktu(id) {
                                // Dapatkan elemen tombol yang diklik
                                var tombol = document.getElementById("btnSelesai_" + id);

                                // Buat objek Date untuk mendapatkan waktu sekarang
                                var waktuSekarang = new Date();

                                // Dapatkan komponen waktu (jam, menit, detik)
                                var jam = waktuSekarang.getHours();
                                var menit = waktuSekarang.getMinutes();
                                var detik = waktuSekarang.getSeconds();

                                // Format waktu menjadi string yang sesuai
                                var waktuString = jam + ":" + menit + ":" + detik;

                                // Tambahkan waktu ke dalam tombol
                                tombol.innerText = waktuString;
                            }
                        </script>

                        <td>
                            <button class="btn text-warning" data-toggle="modal" data-target="#modalFormAbsensi"
                                data-mode="edit" data-id="{{ $p->id }}" data-nama="{{ $p->namaKaryawan }}"
                                data-tanggal="{{ $p->tanggalMasuk }}" data-waktu="{{ $p->waktuMasuk }}"
                                data-status="{{ $p->status }}" data-waktu="{{ $p->waktuKeluar }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form method="post" action="{{ route('absensi.destroy', $p->id) }}"
                                style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn text-danger delete-data"
                                    data-nama="{{ $p->namaKaryawan }}">
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
