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
                        <li class="breadcrumb-item active" aria-current="page">Bulanan</li>
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
                            <h5 class="card-title">Cari dibulan lain</h5>
                            <div class="input-group mb-3">
                                <input type="month" class="form-control" placeholder="cari tanggal" name="tanggal" id="tanggal" value="{{ date('Y-m') }}">
                                <button class="btn btn-primary" id="search">Cari</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <table id="data-harian" class="table dt-table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="30%">Tanggal</th>
                                    <th width="20%">Jumlah Barang</th>
                                    <th width="35%">Total Pembayaran</th>
                                    <th width="10%">Lihat</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <svg> ... </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive" id="tabel-detail">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">barang</th>
                                    <th class="text-center" scope="col">Jumlah</th>
                                    <th class="text-center" scope="col">Total</th>
                                </tr>
                                <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal"><i class="flaticon-cancel-12"></i> Tutup </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="/assets/src/assets/js/jquery-3.5.1.js"></script>
    <script src="/assets/src/plugins/src/table/datatable/datatables.js"></script>
    <script>

        $(document).ready(() => {
            let tanggal = $('#tanggal').val();
            getPP(tanggal);
            table(tanggal);
        });

        $(document).on('click', '#search', function(e){
            let tanggal = $('#tanggal').val();
            $('#data-harian').DataTable().destroy();
            getPP(tanggal)
            table(tanggal)
        });

        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
            style: "decimal",
            currency: "IDR"
            }).format(number);
        }

        function getPP(tanggal){
            $.ajax({
                url: "{{ url('get_ppb') }}",
                type: 'GET',
                dataType: 'json',
                data: {'tanggal': tanggal},
                success: function(resnpose){
                    $('#pendapatan').html(`<h4> Rp. `+rupiah(resnpose.pendapatan)+`</h4>`);
                    $('#penjualan').html(`<h4>`+resnpose.penjualan+` Item</h4>`);
                }
            });
        }

        function table(tanggal){
            $('#data-harian').DataTable({
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                    "<'table-responsive'tr>" +
                    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "oLanguage": {
                    "oPaginate": {
                        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                    },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                },                
                // "stripeClasses": [],
                "lengthMenu": [[5, 10, 25, 50, 100, -1],[5, 10, 25, 50, 100, 'All']],
                "pageLength": 10, 
                processing: true,
                serverSide: true,
                responseive: true,
                ajax: {
                    url:"{{ url('json_rb') }}",
                    type:"POST",
                    data:function(d){
                        d._token = "{{ csrf_token() }}",
                        d.tanggal = tanggal
                    }
                },
                columns:[
                    {
                        "render": function(data, type, row, meta){
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        "render": function(data, type, row, meta){
                        return row.tanggal
                        }
                    },
                    {
                        "render": function(data, type, row, meta){
                        return row.jumlah+' item'
                        }
                    },
                    {
                        "render": function(data, type, row, meta){
                        return 'Rp. '+rupiah(row.harga)
                        }
                    },
                    {
                        "render": function(data, type, row, meta){
                        return `
                        <div class="action-btns">
                            <a href="#" class="btn btn-sm btn-success" data-tgl="`+row.tanggal+`" id="lihat_detail"> Lihat </a>
                        </div>
                        `
                        }
                    },
                ]
            });
        }

        $(document).on('click', '#lihat_detail', function(e) {
            let tgl = $(this).data('tgl');
            $.ajax({
                url: "{{ url('sd_rb') }}",
                type: 'GET',
                dataType: 'json',
                data: { 'tanggal' : tgl },
                success: function(response) {
                    if (response.status == 401) {
                        sweetAlert('warning', response.message);
                    } else {
                        $('#modalDetail').modal('show');
                        $('#tabel-detail table tbody').empty();
                        var detaildata = response.data
                        var no = 1;
                        detaildata.forEach((params) => {
                            let body = 
                            `<tr>
                                <td>`+no+`</td>
                                <td>`+params.nama_barang+`</td>
                                <td style="text-align:center">`+params.jml_barang+` Pcs</td>
                                <td style="text-align:center">Rp. `+rupiah(params.total_harga)+`</td>
                            </tr>`
                            $('#tabel-detail table tbody').append(body);
                        no++;
                        })
                    }
                }
            });
        });

        
        // template sweetalert
        function sweetAlert(icon, title) {
            Swal.fire({
                icon: icon,
                title: title,
            });
        }


    </script>
@endpush
