@extends('template/layout')

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
                                <h2>meja</h2>
                                <div class="float-right ml-auto">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modalFormMeja">
                                        Tambah meja
                                    </button>
                                    <a href="{{ route('export-meja-pdf') }}" class="btn btn-danger">
                                        <i class="fas fa-file-pdf"></i> Export PDF
                                    </a>
                                    <a href="{{ route('export-meja') }}" class="btn btn-success">
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
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" \
                                            aria-label="Close">
                                        </button>
                                    </div>
                                @endif
                                <div class="mt-3">
                                    @include('meja.data')
                                    @include('meja.modal')
                                </div>
                                <!-- Button trigger modal -->
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <br />
        </div>
        @include('meja.form')
    </section>
@endsection

@push('script')
    <script>
        $('#tbl-meja').DataTable()

        $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
            $('.alert-success').slideUp(500)
        })
        $('.alert-danger').fadeTo(2000, 500).slideUp(500, function() {
            $('.alert-danger').slideUp(500)
        })

        console.log($('.delete-data'))

        $('.delete-data').on('click', function(e) {
            e.preventDefault()
            const data = $(this).closest('tr').find('td:eq(1)').text()
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
                    $(e.target).closest('form').submit()
                else swal.close()
            })
        })

        $('#modalFormMeja').on('show.bs.modal', function(e) {
            const btn = $(e.relatedTarget)
            const mode = btn.data('mode')
            const nomor_meja = btn.data('nomor_meja')
            const kapasitas = btn.data('kapasitas')
            const status = btn.data('status')
            const id = btn.data('id')
            const modal = $(this)
            if (mode === 'edit') {
                modal.find('.modal-title').text('Edit Data')
                modal.find('#nomor_meja').val(nomor_meja)
                modal.find('#kapasitas').val(kapasitas)
                modal.find('#status').val(status)
                modal.find('.modal-body form').attr('action', '{{ url('meja') }}/' + id)
                modal.find('#method').html('@method('PATCH')')
            } else {
                modal.find('.modal-title').text('Input Data meja')
                modal.find('#nomor_meja').val('')
                modal.find('#kapasitas').val('')
                modal.find('#status').val('')
                modal.find('#method').html('')
                modal.find('.modal-body form').attr('action', '{{ url('meja') }}')
            }
        })

        $(document).ready(function() {
            $('#tbl-meja tbody').on('dblclick', 'td', function() {
                var column_num = parseInt($(this).index()) + 1;
                var row_num = parseInt($(this).closest('tr').find('button[data-mode=edit]').data('id'));
                var col_name = $(this).closest('table').find('th').eq(column_num - 1).text();
                if (col_name === 'Status') {
                    var current_data = $(this).text();
                    $(this).html('<select class="form-control select-status" data-id="' + row_num + '">' +
                        '<option value="Di Pesan">dipesan</option>' +
                        '<option value="Kosong">Kosong</option>' +
                        '<option value="Tersedia">Tersedia</option>' +

                        '</select>');
                    $(this).find('.select-status').val(current_data);

                }
            })
        });

        $('#tbl-meja tbody').on('change', '.select-status', function() {
            var new_status = $(this).val();
            var row_num = $(this).data('id');
            var valid_statuses = ['Di Pesan', 'Kosong', 'Tersedia']; // Daftar status yang valid

            if (!valid_statuses.includes(new_status)) {
                var confirm_custom_status = confirm(
                    'Status tidak valid. Apakah Anda ingin menggunakan status kustom?');
                if (confirm_custom_status) {
                    var input_status = prompt('Masukkan status baru:');
                    if (input_status !== null && input_status.trim() !== '') {
                        new_status = input_status.trim();
                    } else {
                        $(this).val($(this).data(
                            'prev-status')); // Kembalikan ke status sebelumnya jika status kustom tidak valid
                        return;
                    }
                } else {
                    $(this).val($(this).data(
                        'prev-status'
                        )); // Kembalikan ke status sebelumnya jika tidak ingin menggunakan status kustom
                    return;
                }
            }

            // Send the new status to the backend using AJAX
            $.ajax({
                type: "POST",
                url: "update-status",
                data: {
                    "_token": "{{ csrf_token() }}",
                    row_num: row_num,
                    new_status: new_status
                },
                success: function(response) {
                    // Handle the response
                    console.log(response);
                },
                error: function(error) {
                    // Handle the error
                    console.log(error);
                }

            });

            $(this).parent().text(new_status);
        });
    </script>
@endpush
