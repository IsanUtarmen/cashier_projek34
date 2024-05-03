@extends('template.layout')

@section('content')
    <div class="right_col" role="main">
        <!-- /top tiles -->
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="dashboard_graph">
                    <div class="row x_title">
                        <div class="col-md-6">
                            <h3>Tentang Kami</h3>
                        </div>
                        <div class="col-md-6">
                            <div id="reportrange" class="pull-right"
                                style="
                                    background: #fff;
                                    cursor: pointer;
                                    padding: 5px 10px;
                                    border: 1px solid #ccc;
                                    border-radius: 4px;
                                    box-shadow: 0 1px 1px rgba(0,0,0,0.04);
                                ">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                <span style="color: #333;">December 30, 2014 - January 28, 2015</span> <!-- Ubah warna teks -->
                                <b class="caret"></b>
                            </div>
                        </div>
                    </div>

                    <div class="card-body row d-flex justify-content-evenly" style="gap: 1rem">
                        <div class="col-5" style="background-color: #f7f7f7; padding: 20px; border-radius: 10px;"> <!-- Tambahkan warna latar belakang dan radius sudut -->
                            <h2 style="color: #73879c;">Tentang Aplikasi</h2> <!-- Ubah warna teks -->
                            <p style="color: #555;">Aplikasi ini dibuat saat tugas project sekolah. Aplikasi ini masih dalam proses
                                pembuatan, jadi ini belum begitu
                                sempurna.</p> <!-- Ubah warna teks -->
                        </div>
                        <div class="col-5" style="background-color: #f7f7f7; padding: 20px; border-radius: 10px;">
                            <h2 style="color: #73879c;">Sejarah Aplikasi</h2>
                            <p style="color: #555;">Aplikasi ini dibuat saat tugas project sekolah. Aplikasi ini masih dalam proses
                                pembuatan, jadi ini belum begitu
                                sempurna.</p>
                        </div>
                        <div class="col-5" style="background-color: #f7f7f7; padding: 20px; border-radius: 10px;">
                            <h2 style="color: #73879c;">Pelayanan</h2>
                            <ul class="list-group s-none">
                                <li class="list-group-item" style="background-color: #73879c; color: #fff;">Personal Branding</li> <!-- Tambahkan warna latar belakang dan ubah warna teks -->
                                <li class="list-group-item" style="background-color: #73879c; color: #fff;">Website</li>
                                <li class="list-group-item" style="background-color: #73879c; color: #fff;">UI Designer</li>
                            </ul>
                        </div>
                        <div class="col-5" style="background-color: #f7f7f7; padding: 20px; border-radius: 10px;">
                            <h2 style="color: #73879c;">Sejarah</h2>
                            <p style="color: #555;">Aplikasi ini dibuat saat tugas project sekolah. Aplikasi ini masih dalam proses
                                pembuatan, jadi ini belum begitu
                                sempurna.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
