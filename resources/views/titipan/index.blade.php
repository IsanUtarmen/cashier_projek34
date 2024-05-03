@extends('template.layout')

@push('style')
@endpush

@section('content')
    <section class="content">
        <div class="right_col" role="main">
            <!-- /top tiles -->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="dashboard_graph">
                        <div class="row x_title">
                            <div class="col-md-6">
                                <h3>
                                    PROJECT UJIKOM
                                    <h3>CHASIER GACORAN</h3>
                                </h3>
                            </div>
                            <div class="col-md-6">
                                <div id="reportrange" class="pull-right"
                                    style="
                                    background: #fff;
                                    cursor: pointer;
                                    padding: 5px 10px;
                                    border: 1px solid #ccc;
                                ">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                    <span>December 30, 2014 - January 28, 2015</span>
                                    <b class="caret"></b>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-3 bg-white">
                            <div class="x_title">
                                <h2>Produk</h2>
                                <div class="float-right ml-auto">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modalFormTitipan">
                                        Tambah Produk Titipan
                                    </button>
                                    <a href="{{ route('export-titipan') }}" class="btn btn-success">
                                        <i class="fa fa-file-excel"></i> Export
                                    </a>
                                    <!-- Button Import -->
                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                        data-target="#formImport">
                                        <i class="fas fa-file-excel"></i> Import
                                    </button>



                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        </button>
                                    </div>
                                @endif
                                <div class="mt-3">
                                    @include('titipan.data')
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <br />
        </div>
        @include('titipan.form')
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#tbl-titipan').DataTable();

            $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
                $('.alert-success').slideUp(500);
            });

            $('.alert-danger').fadeTo(2000, 500).slideUp(500, function() {
                $('.alert-danger').slideUp(500);
            });

            $('.delete-data').on('click', function(e) {
                e.preventDefault();
                const data = $(this).closest('tr').find('td:eq(1)').text();
                Swal.fire({
                    title: `Apakah data <span style="color:red">${data}</span> akan dihapus?`,
                    text: "Data tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus data ini!'
                }).then((result) => {
                    if (result.isConfirmed)
                        $(e.target).closest('form').submit();
                    else
                        swal.close();
                });
            });

            $('#modalFormTitipan').on('show.bs.modal', function(e) {
                const btn = $(e.relatedTarget);
                const mode = btn.data('mode');
                const nama_produk = btn.data('nama_produk');
                const nama_suplier = btn.data('nama_suplier');
                const harga_beli = btn.data('harga_beli');
                const harga_jual = btn.data('harga_jual');
                const stock = btn.data('stock');
                const keterangan = btn.data('keterangan');
                const id = btn.data('id');
                const modal = $(this);
                if (mode === 'edit') {
                    modal.find('.modal-title').text('Edit Data');
                    modal.find('#nama_produk').val(nama_produk);
                    modal.find('#nama_suplier').val(nama_suplier);
                    modal.find('#harga_beli').val(harga_beli);
                    modal.find('#harga_jual').val(harga_jual);
                    modal.find('#stock').val(stock);
                    modal.find('#keterangan').val(keterangan);
                    modal.find('#method').html('@method('PUT')');
                    modal.find('.modal-content form').attr('action', '{{ url('produk_titipan') }}/' + id);
                } else {
                    modal.find('.modal-title').text('Tambah Data titipan');
                    modal.find('#nama_produk').val('');
                    modal.find('#nama_suplier').val('');
                    modal.find('#harga_beli').val('');
                    modal.find('#harga_jual').val('');
                    modal.find('#stock').val('');
                    modal.find('#keterangan').val('');
                    modal.find('.modal-body form').attr('action', '{{ url('produk_titipan') }}');
                }
            });

            // Menggunakan event input untuk mendeteksi perubahan pada input harga beli
            $('#harga_beli').on('input', function() {
                // Mendapatkan nilai harga beli dari input
                var hargaBeli = parseFloat($(this).val());

                // Melakukan perhitungan harga jual
                var keuntunganPercentage = 70;
                var hargaJual = Math.round((hargaBeli * (100 + keuntunganPercentage)) / 100 / 500) * 500;

                // Mengisi nilai pada input harga jual
                parseFloat($('#harga_jual').val(hargaJual));
            });
        });
    </script>
@endpush
