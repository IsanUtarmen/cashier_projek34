@extends('template/layout2')

@section('content')
    <section class="content">
        <div class="right_col" role="main">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="dashboard_graph">
                        <div class="row x_title">
                            <div class="col-md-6">
                                <h3>Laporan</h3>
                                <h1 style=" font-family: 'Caveat', cursive;"> Coffe'San</h1>
                            </div>
                            <div class="col-md-6">
                                <div id="reportrange" class="pull-right">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                    <span>December 30, 2014 - January 28, 2015</span>
                                    <b class="caret"></b>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-3 bg-white">
                            <div class="x_title">
                                <div class="row align-items-center">
                                    <div class="col-md-12 text-center mb-3">
                                        <h3>Laporan</h3>
                                    </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <div class="float-right ml-auto">
                                                        <a href="{{ route('export-laporan')}}" class="btn btn-success">
                                                            <i class="fa fa-file-excel"></i> Export
                                                        </a>
                                                        <a href="{{ route('pdflaporan')}}" class="btn btn-danger ml-2">
                                                            <i class="fa fa-file-pdf"></i> Export PDF
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mt-3">
                                    @include('laporan.data')
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <br />
        </div>
    </section>
@endsection

@push('script')
    <script>
        $('#tbl-laporan').DataTable()
    </script>
@endpush
