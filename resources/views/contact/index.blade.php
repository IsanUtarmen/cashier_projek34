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
                                    PROJECT TO2
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
                                <h2>Contact Us</h2>

                                <div class="float-right ml-auto">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modalFormStok">
                                        Tambah Pertanyaan
                                    </button>
                                </div>
                                <div class="clearfix"></div>
                                <div class="contact-info">
                                    <h3>Cibaregbegg</h3>
                                    <p>Jl. haki No. 123</p>
                                    <p>Kota Contoh, 12345</p>

                                    <div class="image-container">
                                        <style>
                                        .image-container {
                                            display: flex;
                                            justify-content: center;
                                        }
                                        </style>
                                        <img src="foto.png" alt="Foto Kantor" width="400px">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8155.214223006024!2d107.1365649699251!3d-6.827393371275427!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68525a7dd2a209%3A0xfd1701320c9a5a31!2sJl.%20Aria%20Cikondang%20No.75%2C%20Sayang%2C%20Kec.%20Cianjur%2C%20Kabupaten%20Cianjur%2C%20Jawa%20Barat%2043213!5e0!3m2!1sid!2sid!4v1644550886312!5m2!1sid!2sid"width="100%"
                            height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                            tabindex="0"></iframe>
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
                                <button type="button" class="btn-close" data-bs-dismiss="alert" \ aria-label="Close">
                                </button>
                                <a href="{{ route('export-jenis') }}" class="btn btn-success">
                                    <i class="fa fa-file-excel"></i> Export
                                </a>
                                <!-- Button Import -->
                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                    data-target="#formImport">
                                    <i class="fas fa-file-excel"></i> Import
                                </button>
                            </div>
                        @endif
                        <div class="mt-3">
                            @include('contact.form')
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
        @include('contact.form')
    </section>
@endsection

@push('script')
    <script>
        $('#tbl-stok').DataTable()

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

        $('#modalFormStok').on('show.bs.modal', function(e) {
            const btn = $(e.relatedTarget)
            const mode = btn.data('mode')
            const menu_id = btn.data('menu_id')
            const jumlah = btn.data('jumlah')
            const id = btn.data('id')
            const modal = $(this)
            if (mode === 'edit') {
                modal.find('.modal-title').text('Edit Data')
                modal.find('#menu_id').val(menu_id)
                modal.find('#jumlah').val(jumlah)
                modal.find('.modal-body form').attr('action', '{{ url('stok') }}/' + id)
                modal.find('#method').html('@method('PATCH')')
            } else {
                modal.find('.modal-title').text('Input Data Stok')
                modal.find('#menu_id').val('')
                modal.find('#jumlah').val('')
                modal.find('#method').html('')
                modal.find('.modal-body form').attr('action', '{{ url('stok') }}')
            }
        })
    </script>
@endpush
