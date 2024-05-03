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
                                <h1 style=" font-family: 'Caveat', cursive;"> Coffe'San</h1>
                            </div>
                            <div class="col-md-6">
                                <div class="tanggal m-2 ">

                                    <label for="tanggal_mulai">Tanggal Mulai:</label>
                                    <input type="date" id="tanggal_mulai" name="tanggal_mulai">

                                    <label for="tanggal_selesai">Tanggal Selesai:</label>
                                    <input type="date" id="tanggal_selesai" name="tanggal_selesai">

                                </div>
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
                                    <!-- top tiles -->
                                    <div class="tile_count">
                                        <div class="col-md-2 col-sm-4  tile_stats_count">
                                            <span class="count_top">Jumlah Transaksi</span>
                                            <div class="count green"> <i
                                                    class="fa-solid fa-basket-shopping"></i>{{ $count_transaksi }}</div>
                                            <span class="count_bottom"><i class="green"></i></i>Transaksi</span>
                                        </div>
                                        <div class="col-md-1 col-sm-4 ">
                                        </div>
                                        <div class="col-md-2 col-sm-4  tile_stats_count">
                                            <span class="count_top"><i class="fa-solid fa-table"></i> Jumlah
                                                Pendapatan</span>
                                            <div class="count ">Rp{{ number_format($pendapatan, 2) }}</div>
                                            <span class="count_bottom"><i class="green"> </i> </span>
                                        </div>
                                        <div class="col-md-1 col-sm-4 ">
                                        </div>
                                        <div class="col-md-2 col-sm-4  tile_stats_count">
                                            <span class="count_top"><i class="fa-solid fa-table"></i> Jumlah Menu</span>
                                            <div class="count">{{ $count_menu }}</div>
                                            <span class="count_bottom"><i class="green"> </i> Menu Yang Tersedia </span>
                                        </div>
                                        <div class="col-md-1 col-sm-4 ">
                                        </div>
                                        <div class="col-md-2 col-sm-4  tile_stats_count">
                                            <span class="count_top"><i class="fa-solid fa-users"></i> Sisa stok</span>
                                            <div class="count">{{ $sisaStok }}</div>
                                            <span class="count_bottom"><i class="green"></i> Sisa Stok</span>
                                        </div>
                                        <div class="col-md-1 col-sm-4 ">
                                        </div>
                                        </br>

                                        <div class="col-md-8 col-sm-6">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2>Line graph <small>Pendapatan per Tanggal</small></h2>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">
                                                    <canvas id="dailyIncomeChart"></canvas>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="col-md-4 col-sm-5 ">
                                            <div class="x_panel tile fixed_height_330">
                                                <div class="x_title">
                                                    <h2>Top 5 Penjualan</h2>
                                                    <ul class="nav navbar-right panel_toolbox">
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                                @foreach ($most_ordered_menu as $menu => $count)
                                                    @php
                                                        // Temukan objek menu sesuai dengan nama_menu
                                                        $menuObject = \App\Models\Menu::where(
                                                            'nama_menu',
                                                            $menu,
                                                        )->first();
                                                    @endphp
                                                    @if ($menuObject)
                                                        <div class="d-flex align-items-center mb-2">
                                                            <!-- Gunakan URL yang sesuai untuk mengakses gambar -->
                                                            <img src="{{ asset('images/' . $menuObject->image) }}"
                                                                alt="{{ $menuObject->nama_menu }}" class="mr-2"
                                                                style="width: 50px; height: 50px;">
                                                            <p>{{ $menuObject->nama_menu }}</p>
                                                            <p>{{ $count }} </p>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            </ul>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Transaksi Terbaru</h4>
                                                </div>
                                                <ul class="list-group list-group-flush">
                                                    @foreach ($latest_transactions as $transaction)
                                                        <li class="list-group-item">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <span>{{ $transaction->created_at }}</span>
                                                                <span>Total: Rp{{ $transaction->subtotal }}</span>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-5 ">
                                            <div class="x_panel tile fixed_height_330">
                                                <div class="x_title">
                                                    <h2>Stok Ter Rendah</h2>
                                                    <ul class="nav navbar-right panel_toolbox">
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                                @foreach ($stokTerendah as $stok)
                                                    <img src="{{ asset('images/' . $stok->menu->image) }}"
                                                        alt="{{ $stok->menu->nama_menu }}" class="mr-3"
                                                        style="width: 50px; height: 50px;">
                                                    <p> {{ $stok->menu->nama_menu }} </p>
                                                    <p> Jumlah: {{ $stok->jumlah }} </p>
                                                @endforeach
                                            </div>
                                            </ul>
                                        </div>
                                        <!-- Button trigger modal -->
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <br />
            </div>
        </div>
        <!-- include -->
    </section>
    <!-- include -->
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"
        integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('dailyIncomeChart').getContext('2d');
        var dailyIncomeChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_keys($totalPendapatanPerHari)) !!},
                datasets: [{
                    label: 'Pendapatan Per Hari',
                    data: {!! json_encode(array_values($totalPendapatanPerHari)) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgb(0, 123, 255)',
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        $('#tanggal_mulai, #tanggal_selesai').change(function() {
            var tanggalMulai = $('#tanggal_mulai').val();
            var tanggalSelesai = $('#tanggal_selesai').val();
            $.ajax({
                url: '/get-chart-data',
                type: 'GET',
                data: {
                    tanggal_mulai: tanggalMulai,
                    tanggal_selesai: tanggalSelesai
                },
                success: function(data) {
                    dailyIncomeChart.data.labels = Object.keys(data);
                    dailyIncomeChart.data.datasets[0].data = Object.values(data);
                    dailyIncomeChart.update();

                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>
@endpush
