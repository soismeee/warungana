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
                <div class="card">
                    <div class="card-body">
                        <p class="mb-4"> Data penjualan barang hari ini {{ date('d/m/Y') }}.</p>
                        <div class="table-responsive">
                            <table class="table table-no-space table-bordered">
                                <thead>
                                    <tr>
                                        <th width="5%" class="" scope="col">#</th>
                                        <th width="25%" scope="col">Barang</th>
                                        <th width="10%" class="text-center" scope="col">Jumlah</th>
                                        <th width="30%" class="text-center" scope="col">Harga</th>
                                        <th width="30%" class="text-center" scope="col">Total</th>
                                    </tr>
                                    <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="5" class="text-center" id="loading">
                                            <div class="spinner-border" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot style="display:none">
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection

@push('js')
    <script src="/assets/src/assets/js/jquery-3.5.1.js"></script>

    <script>
        $(document).ready(() => {
            loaddata();
        });

        // fungsi format number (ke rupiah)
        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
            style: "decimal",
            currency: "IDR"
            }).format(number);
        }

        // fungsi untuk mengambil data ketika halaman pertama kali akses
        function loaddata() {
            $.ajax({
                type: "GET",
                url: "{{ url('json_harian') }}",
                success: function (response){
                    $('#loading').hide()
                    if(response.status == 401){
                        let datakosong =
                        `
                        <tr class="text-center">
                            <td colspan="5">`+response.message+`</td>
                        </tr>
                        `
                        $('table tbody').append(datakosong);
                    }else{
                        var data = response.data
                        data.forEach((params) => {
                            var span = 'danger';
                            if (params.kategori == "eceran") {
                                span = 'secondary'   
                            }
                            let body = 
                            `<tr>
                                <td>`+params.no+`</td>
                                <td>`+params.nama+` <span class="badge bg-`+span+`">`+params.kategori+`</span></td>
                                <td style="text-align:center">`+rupiah(params.jumlah)+` Pcs</td>
                                <td>Rp. `+rupiah(params.harga)+`</td>
                                <td>Rp. `+rupiah(params.total)+`</td>
                            </tr>`
                            $('table tbody').append(body);
                        })
                        $('tfoot').show();
                        let foot = 
                        `
                            <tr>
                                <td colspan="4" style="text-align:right"><strong>Total Pendapatan</strong></td>
                                <td class="text-left"><strong> Rp. `+rupiah(response.grandtotal)+`</strong></td>
                            </tr>
                        `
                        $('table tfoot').append(foot);
                    }
                }
            });
        }
    </script>
@endpush