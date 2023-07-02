@extends('layouts.main')
@push('css')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="/assets/src/plugins/src/table/datatable/datatables.css">

    <link rel="stylesheet" type="text/css" href="/assets/src/plugins/css/light/table/datatable/dt-global_style.css">
    <link rel="stylesheet" type="text/css" href="/assets/src/plugins/css/dark/table/datatable/dt-global_style.css">
    <!-- END PAGE LEVEL STYLES -->
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
                            <h4 class="mb-0" id="pendapatan">Rp. 0</h4>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Penjualan</h5>
                            <h4 class="mb-0" id="penjualan">0 Item</h4>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Cari ditanggal lain</h5>
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" placeholder="cari tanggal" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}">
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
                                <p class="card-text mb-0" id="uangjan">Jumlah Uang :</p>
                                <p class="card-text" id="itemjan">Jumlah Barang :</p>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="eceranjan">Rp. 0</h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosirjan">Rp. 0</h6>
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
                                <p class="card-text mb-0" id="uangfeb">Jumlah Uang :</p>
                                <p class="card-text" id="itemfeb">Jumlah Barang :</p>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="eceranfeb">Rp. 0</h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosirfeb">Rp. 0</h6>
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
                                <p class="card-text mb-0" id="uangmar">Jumlah Uang :</p>
                                <p class="card-text" id="itemmar">Jumlah Barang :</p>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="eceranmar">Rp. 0</h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosirmar">Rp. 0</h6>
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
                                <p class="card-text mb-0" id="uangapr">Jumlah Uang :</p>
                                <p class="card-text" id="itemapr">Jumlah Barang :</p>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="eceranapr">Rp. 0</h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosirapr">Rp. 0</h6>
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
                                <p class="card-text mb-0" id="uangmei">Jumlah Uang :</p>
                                <p class="card-text" id="itemmei">Jumlah Barang :</p>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="eceranmei">Rp. 0</h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosirmei">Rp. 0</h6>
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
                                <p class="card-text mb-0" id="uangjun">Jumlah Uang :</p>
                                <p class="card-text" id="itemjun">Jumlah Barang :</p>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="eceranjun">Rp. 0</h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosirjun">Rp. 0</h6>
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
                                <p class="card-text mb-0" id="uangjul">Jumlah Uang :</p>
                                <p class="card-text" id="itemjul">Jumlah Barang :</p>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="eceranjul">Rp. 0</h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosirjul">Rp. 0</h6>
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
                                <p class="card-text mb-0" id="uangagt">Jumlah Uang :</p>
                                <p class="card-text" id="itemagt">Jumlah Barang :</p>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="eceranagt">Rp. 0</h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosiragt">Rp. 0</h6>
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
                                <p class="card-text mb-0" id="uangsep">Jumlah Uang :</p>
                                <p class="card-text" id="itemsep">Jumlah Barang :</p>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="eceransep">Rp. 0</h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosirsep">Rp. 0</h6>
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
                                <p class="card-text mb-0" id="uangokt">Jumlah Uang :</p>
                                <p class="card-text" id="itemokt">Jumlah Barang :</p>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="eceranokt">Rp. 0</h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosirokt">Rp. 0</h6>
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
                                <p class="card-text mb-0" id="uangnov">Jumlah Uang :</p>
                                <p class="card-text" id="itemnov">Jumlah Barang :</p>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="ecerannov">Rp. 0</h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosirnov">Rp. 0</h6>
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
                                <p class="card-text mb-0" id="uangdes">Jumlah Uang :</p>
                                <p class="card-text" id="itemdes">Jumlah Barang :</p>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Eceran</a>
                                        <h6 id="ecerandes">Rp. 0</h6>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="text-warning mt-2 d-inline-block">Grosir</a>
                                        <h6 id="grosirdes">Rp. 0</h6>
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
    <script>
        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
            style: "decimal",
            currency: "IDR"
            }).format(number);
        }

        $(document).ready(function () {
            let tanggal = $('#tanggal').val();
            tabel(tanggal);
        });

        function getPP(tanggal){
            $.ajax({
                url: "{{ url('get_ppt') }}",
                type: 'GET',
                dataType: 'json',
                data: {'tanggal': tanggal},
                success: function(resnpose){
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
                    $('#uangjan').html("Jumlah Uang : Rp. "+rupiah(januang.harga));
                    $('#itemjan').html("Jumlah Barang : "+januang.jumlah);
                    $('#eceranjan').html("Rp. "+rupiah(januang.eceran));
                    $('#grosirjan').html("Rp. "+rupiah(januang.grosir));

                    var febuang = response.data['0'].feb
                    $('#uangfeb').html("Jumlah Uang : Rp. "+rupiah(febuang.harga));
                    $('#itemfeb').html("Jumlah Barang : "+febuang.jumlah);
                    $('#eceranfeb').html("Rp. "+rupiah(febuang.eceran));
                    $('#grosirfeb').html("Rp. "+rupiah(febuang.grosir));

                    var maruang = response.data['0'].mar
                    $('#uangmar').html("Jumlah Uang : Rp. "+rupiah(maruang.harga));
                    $('#itemmar').html("Jumlah Barang : "+maruang.jumlah);
                    $('#eceranmar').html("Rp. "+rupiah(maruang.eceran));
                    $('#grosirmar').html("Rp. "+rupiah(maruang.grosir));

                    var apruang = response.data['0'].apr
                    $('#uangapr').html("Jumlah Uang : Rp. "+rupiah(apruang.harga));
                    $('#itemapr').html("Jumlah Barang : "+apruang.jumlah);
                    $('#eceranapr').html("Rp. "+rupiah(apruang.eceran));
                    $('#grosirapr').html("Rp. "+rupiah(apruang.grosir));

                    var meiuang = response.data['0'].mei
                    $('#uangmei').html("Jumlah Uang : Rp. "+rupiah(meiuang.harga));
                    $('#itemmei').html("Jumlah Barang : "+meiuang.jumlah);
                    $('#eceranmei').html("Rp. "+rupiah(meiuang.eceran));
                    $('#grosirmei').html("Rp. "+rupiah(meiuang.grosir));

                    var junuang = response.data['0'].jun
                    $('#uangjun').html("Jumlah Uang : Rp. "+rupiah(junuang.harga));
                    $('#itemjun').html("Jumlah Barang : "+junuang.jumlah);
                    $('#eceranjun').html("Rp. "+rupiah(junuang.eceran));
                    $('#grosirjun').html("Rp. "+rupiah(junuang.grosir));

                    var juluang = response.data['0'].jul
                    $('#uangjul').html("Jumlah Uang : Rp. "+rupiah(juluang.harga));
                    $('#itemjul').html("Jumlah Barang : "+juluang.jumlah);
                    $('#eceranjul').html("Rp. "+rupiah(juluang.eceran));
                    $('#grosirjul').html("Rp. "+rupiah(juluang.grosir));

                    var agtuang = response.data['0'].agt
                    $('#uangagt').html("Jumlah Uang : Rp. "+rupiah(agtuang.harga));
                    $('#itemagt').html("Jumlah Barang : "+agtuang.jumlah);
                    $('#eceranagt').html("Rp. "+rupiah(agtuang.eceran));
                    $('#grosiragt').html("Rp. "+rupiah(agtuang.grosir));

                    var sepuang = response.data['0'].sep
                    $('#uangsep').html("Jumlah Uang : Rp. "+rupiah(sepuang.harga));
                    $('#itemsep').html("Jumlah Barang : "+sepuang.jumlah);
                    $('#eceransep').html("Rp. "+rupiah(sepuang.eceran));
                    $('#grosirsep').html("Rp. "+rupiah(sepuang.grosir));

                    var oktuang = response.data['0'].okt
                    $('#uangokt').html("Jumlah Uang : Rp. "+rupiah(oktuang.harga));
                    $('#itemokt').html("Jumlah Barang : "+oktuang.jumlah);
                    $('#eceranokt').html("Rp. "+rupiah(oktuang.eceran));
                    $('#grosirokt').html("Rp. "+rupiah(oktuang.grosir));

                    var novuang = response.data['0'].nov
                    $('#uangnov').html("Jumlah Uang : Rp. "+rupiah(novuang.harga));
                    $('#itemnov').html("Jumlah Barang : "+novuang.jumlah);
                    $('#ecerannov').html("Rp. "+rupiah(novuang.eceran));
                    $('#grosirnov').html("Rp. "+rupiah(novuang.grosir));

                    var desuang = response.data['0'].des
                    $('#uangdes').html("Jumlah Uang : Rp. "+rupiah(desuang.harga));
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
            $('#data-harian').DataTable().destroy();
            getPP(tanggal)
            table(tanggal)
        });
    </script>
@endpush
