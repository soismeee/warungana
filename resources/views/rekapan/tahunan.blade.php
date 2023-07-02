@extends('layouts.main')
@push('css')
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="/assets/src/plugins/src/table/datatable/datatables.css">

<link rel="stylesheet" type="text/css" href="/assets/src/plugins/css/light/table/datatable/dt-global_style.css">
<link rel="stylesheet" type="text/css" href="/assets/src/plugins/css/dark/table/datatable/dt-global_style.css">
<!-- END PAGE LEVEL STYLES -->
<!--  BEGIN CUSTOM STYLE FILE  -->
<link href="/assets/src/plugins/css/light/loaders/custom-loader.css" rel="stylesheet" type="text/css" />
<link href="/assets/src/plugins/css/dark/loaders/custom-loader.css" rel="stylesheet" type="text/css" />
<!--  END CUSTOM STYLE FILE  -->
@endpush

@section('container')
    <div class="layout-px-spacing">

        <div class="middle-content container-xxl p-0">
            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Rekap</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Harian</li>
                    </ol>
                </nav>
            </div>
            <!-- /BREADCRUMB -->
            <div class="row layout-top-spacing">
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Pendapatan</h5>
                            <h4 class="mb-0" id="pendapatan"><div class="spinner-border text-success align-self-center">Loading...</div></h4>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Penjualan</h5>
                            <h4 class="mb-0" id="penjualan"><div class="spinner-border text-secondary align-self-center">Loading...</div></h4>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Cari di tahun lain (ketik) </h5>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="cari tanggal" name="tanggal" id="tanggal" maxlength="4" value="{{ date('Y') }}">
                                <button class="btn btn-primary" id="search">Cari</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="card style-5  mb-md-0 mb-4">
                        <div class="card-content">
                            <div class="card-body">
                                <h5 class="card-title mb-2">Pendapatan bulan Januari</h5>
                                <h5 class="card-text mb-0" id="uangjan">Pendapatan : <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div> </h5>
                                <h5 class="card-text" id="itemjan">Jumlah Barang:  <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="eceranjan"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosirjan"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="card style-5  mb-md-0 mb-4">
                        <div class="card-content">
                            <div class="card-body">
                                <h5 class="card-title mb-2">Pendapatan bulan Februari</h5>
                                <h5 class="card-text mb-0" id="uangfeb">Pendapatan : <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <h5 class="card-text" id="itemfeb">Jumlah Barang:  <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="eceranfeb"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosirfeb"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="card style-5  mb-md-0 mb-4">
                        <div class="card-content">
                            <div class="card-body">
                                <h5 class="card-title mb-2">Pendapatan bulan Maret</h5>
                                <h5 class="card-text mb-0" id="uangmar">Pendapatan : <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <h5 class="card-text" id="itemmar">Jumlah Barang:  <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="eceranmar"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosirmar"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="card style-5  mb-md-0 mb-4">
                        <div class="card-content">
                            <div class="card-body">
                                <h5 class="card-title mb-2">Pendapatan bulan April</h5>
                                <h5 class="card-text mb-0" id="uangapr">Pendapatan : <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <h5 class="card-text" id="itemapr">Jumlah Barang:  <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="eceranapr"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosirapr"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="card style-5  mb-md-0 mb-4">
                        <div class="card-content">
                            <div class="card-body">
                                <h5 class="card-title mb-2">Pendapatan bulan Mei</h5>
                                <h5 class="card-text mb-0" id="uangmei">Pendapatan : <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <h5 class="card-text" id="itemmei">Jumlah Barang:  <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="eceranmei"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosirmei"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="card style-5  mb-md-0 mb-4">
                        <div class="card-content">
                            <div class="card-body">
                                <h5 class="card-title mb-2">Pendapatan bulan Juni</h5>
                                <h5 class="card-text mb-0" id="uangjun">Pendapatan : <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <h5 class="card-text" id="itemjun">Jumlah Barang:  <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="eceranjun"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosirjun"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="card style-5  mb-md-0 mb-4">
                        <div class="card-content">
                            <div class="card-body">
                                <h5 class="card-title mb-2">Pendapatan bulan Juli</h5>
                                <h5 class="card-text mb-0" id="uangjul">Pendapatan : <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <h5 class="card-text" id="itemjul">Jumlah Barang:  <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="eceranjul"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosirjul"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="card style-5  mb-md-0 mb-4">
                        <div class="card-content">
                            <div class="card-body">
                                <h5 class="card-title mb-2">Pendapatan bulan Agustus</h5>
                                <h5 class="card-text mb-0" id="uangagt">Pendapatan : <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <h5 class="card-text" id="itemagt">Jumlah Barang:  <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="eceranagt"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosiragt"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="card style-5  mb-md-0 mb-4">
                        <div class="card-content">
                            <div class="card-body">
                                <h5 class="card-title mb-2">Pendapatan bulan September</h5>
                                <h5 class="card-text mb-0" id="uangsep">Pendapatan : <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <h5 class="card-text" id="itemsep">Jumlah Barang:  <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="eceransep"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosirsep"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="card style-5  mb-md-0 mb-4">
                        <div class="card-content">
                            <div class="card-body">
                                <h5 class="card-title mb-2">Pendapatan bulan Oktober</h5>
                                <h5 class="card-text mb-0" id="uangokt">Pendapatan : <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <h5 class="card-text" id="itemokt">Jumlah Barang:  <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="eceranokt"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosirokt"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="card style-5  mb-md-0 mb-4">
                        <div class="card-content">
                            <div class="card-body">
                                <h5 class="card-title mb-2">Pendapatan bulan November</h5>
                                <h5 class="card-text mb-0" id="uangnov">Pendapatan : <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <h5 class="card-text" id="itemnov">Jumlah Barang:  <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="ecerannov"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosirnov"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="card style-5  mb-md-0 mb-4">
                        <div class="card-content">
                            <div class="card-body">
                                <h5 class="card-title mb-2">Pendapatan bulan Desember</h5>
                                <h5 class="card-text mb-0" id="uangdes">Pendapatan : <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <h5 class="card-text" id="itemdes">Jumlah Barang:  <div class="spinner-grow text-info align-self-center loader-sm">Loading...</div></h5>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="ecerandes"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosirdes"><div class="spinner-border spinner-border-reverse align-self-center loader-sm text-secondary">Loading...</div></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="data"></div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="/assets/src/assets/js/jquery-3.5.1.js"></script>
    {{-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script> --}}
    {{-- <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script> --}}
    <script src="/assets/src/plugins/src/table/datatable/datatables.js"></script>

    <script>
        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
            style: "decimal",
            currency: "IDR"
            }).format(number);
        }

        $(document).ready(function () {
            let tanggal = $('#tanggal').val();
            getPP(tanggal);
            tabel(tanggal);
        });

         // inputan tahun
         let tanggal = document.getElementById("tanggal");
            tanggal.addEventListener("keyup", function(e) {
                this.value = this.value.replace(/\D/g,'');
            });

        function getPP(tanggal){
            $.ajax({
                url: "{{ url('get_ppt') }}",
                type: 'GET',
                dataType: 'json',
                data: {'tanggal': tanggal},
                success: function(resnpose){
                    console.log(resnpose);
                    $('#pendapatan').html(`<h4> Rp. `+rupiah(resnpose.pendapatan)+`</h4>`);
                    $('#penjualan').html(`<h4>`+resnpose.penjualan+` Item</h4>`);
                }
            });
        }
        
        function tabel(tanggal){
            $.ajax({
                url: "{{ url('json_rt') }}",
                type: 'GET',
                dataType: 'json',
                data: {'tanggal': tanggal},
                success: function(response){
                    var januang = response.data['0'].jan
                    $('#uangjan').html("Pendapatan : Rp. "+rupiah(januang.harga));
                    $('#itemjan').html("Jumlah Barang : "+januang.jumlah);
                    $('#eceranjan').html("Rp. "+rupiah(januang.eceran));
                    $('#grosirjan').html("Rp. "+rupiah(januang.grosir));

                    var febuang = response.data['0'].feb
                    $('#uangfeb').html("Pendapatan : Rp. "+rupiah(febuang.harga));
                    $('#itemfeb').html("Jumlah Barang : "+febuang.jumlah);
                    $('#eceranfeb').html("Rp. "+rupiah(febuang.eceran));
                    $('#grosirfeb').html("Rp. "+rupiah(febuang.grosir));

                    var maruang = response.data['0'].mar
                    $('#uangmar').html("Pendapatan : Rp. "+rupiah(maruang.harga));
                    $('#itemmar').html("Jumlah Barang : "+maruang.jumlah);
                    $('#eceranmar').html("Rp. "+rupiah(maruang.eceran));
                    $('#grosirmar').html("Rp. "+rupiah(maruang.grosir));

                    var apruang = response.data['0'].apr
                    $('#uangapr').html("Pendapatan : Rp. "+rupiah(apruang.harga));
                    $('#itemapr').html("Jumlah Barang : "+apruang.jumlah);
                    $('#eceranapr').html("Rp. "+rupiah(apruang.eceran));
                    $('#grosirapr').html("Rp. "+rupiah(apruang.grosir));

                    var meiuang = response.data['0'].mei
                    $('#uangmei').html("Pendapatan : Rp. "+rupiah(meiuang.harga));
                    $('#itemmei').html("Jumlah Barang : "+meiuang.jumlah);
                    $('#eceranmei').html("Rp. "+rupiah(meiuang.eceran));
                    $('#grosirmei').html("Rp. "+rupiah(meiuang.grosir));

                    var junuang = response.data['0'].jun
                    $('#uangjun').html("Pendapatan : Rp. "+rupiah(junuang.harga));
                    $('#itemjun').html("Jumlah Barang : "+junuang.jumlah);
                    $('#eceranjun').html("Rp. "+rupiah(junuang.eceran));
                    $('#grosirjun').html("Rp. "+rupiah(junuang.grosir));

                    var juluang = response.data['0'].jul
                    $('#uangjul').html("Pendapatan : Rp. "+rupiah(juluang.harga));
                    $('#itemjul').html("Jumlah Barang : "+juluang.jumlah);
                    $('#eceranjul').html("Rp. "+rupiah(juluang.eceran));
                    $('#grosirjul').html("Rp. "+rupiah(juluang.grosir));

                    var agtuang = response.data['0'].agt
                    $('#uangagt').html("Pendapatan : Rp. "+rupiah(agtuang.harga));
                    $('#itemagt').html("Jumlah Barang : "+agtuang.jumlah);
                    $('#eceranagt').html("Rp. "+rupiah(agtuang.eceran));
                    $('#grosiragt').html("Rp. "+rupiah(agtuang.grosir));

                    var sepuang = response.data['0'].sep
                    $('#uangsep').html("Pendapatan : Rp. "+rupiah(sepuang.harga));
                    $('#itemsep').html("Jumlah Barang : "+sepuang.jumlah);
                    $('#eceransep').html("Rp. "+rupiah(sepuang.eceran));
                    $('#grosirsep').html("Rp. "+rupiah(sepuang.grosir));

                    var oktuang = response.data['0'].okt
                    $('#uangokt').html("Pendapatan : Rp. "+rupiah(oktuang.harga));
                    $('#itemokt').html("Jumlah Barang : "+oktuang.jumlah);
                    $('#eceranokt').html("Rp. "+rupiah(oktuang.eceran));
                    $('#grosirokt').html("Rp. "+rupiah(oktuang.grosir));

                    var novuang = response.data['0'].nov
                    $('#uangnov').html("Pendapatan : Rp. "+rupiah(novuang.harga));
                    $('#itemnov').html("Jumlah Barang : "+novuang.jumlah);
                    $('#ecerannov').html("Rp. "+rupiah(novuang.eceran));
                    $('#grosirnov').html("Rp. "+rupiah(novuang.grosir));

                    var desuang = response.data['0'].des
                    $('#uangdes').html("Pendapatan : Rp. "+rupiah(desuang.harga));
                    $('#itemdes').html("Jumlah Barang : "+desuang.jumlah);
                    $('#ecerandes').html("Rp. "+rupiah(desuang.eceran));
                    $('#grosirdes').html("Rp. "+rupiah(desuang.grosir));
                }
            });
        }
        
        // template sweetalert
        function sweetAlert(icon, title) {
            Swal.fire({
                icon: icon,
                title: title,
            });
        }

        $(document).on('click', '#search', function(e){
            let tanggal = $('#tanggal').val();
            getPP(tanggal)
            tabel(tanggal)
        });
    </script>
@endpush
