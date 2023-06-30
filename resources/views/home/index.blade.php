@extends('layouts.main')

@push('css')
@endpush
@section('container')
    <div class="layout-px-spacing">

        <div class="middle-content container-xxl p-0">

            <div class="row layout-top-spacing">

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-five">

                        <div class="widget-heading">

                            <a href="javascript:void(0)" class="task-info">
                                <div class="usr-avatar">
                                    <span>PH</span>
                                </div>

                                <div class="w-title">
                                    <h5>Pendapatan harian</h5>
                                    <span>pendapatan di bulan {{ date('F') }}</span>
                                </div>
                            </a>
                        </div>
                        <div class="widget-content">
                            <p>Pendapatan harian diperoleh dari penjualan pada tanggal {{ date('d/m/Y') }}.</p>
                            <h4 class="mt-3">Rp. {{ number_format($harian,0,',','.') }}</h4>
                            Pendapatan kemarin : Rp. {{ number_format($harian_kemarin,0,',','.') }}
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-five">

                        <div class="widget-heading">

                            <a href="javascript:void(0)" class="task-info">
                                <div class="usr-avatar">
                                    <span>PB</span>
                                </div>

                                <div class="w-title">
                                    <h5>Pendapatan Bulanan</h5>
                                    <span>pendapatan di bulan {{ date('F') }}</span>
                                </div>
                            </a>
                        </div>
                        <div class="widget-content">
                            <p>Pendapatan bulanan diperoleh dari penjualan sampai dengan tanggal {{ date('d/m/Y') }}.</p>
                            <h4 class="mt-3">Rp. {{ number_format($bulanan,0,',','.') }}</h4>
                            Pendapatan bulan lalu : Rp. {{ number_format($bulanan_kemarin,0,',','.') }}
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-five">

                        <div class="widget-heading">

                            <a href="javascript:void(0)" class="task-info">
                                <div class="usr-avatar">
                                    <span>PB</span>
                                </div>

                                <div class="w-title">
                                    <h5>Pendapatan Tahunan</h5>
                                    <span>pendapatan di tahun {{ date('Y') }}</span>
                                </div>
                            </a>
                        </div>
                        <div class="widget-content">
                            <h1 class="mt-3">Rp. {{ number_format($tahunan,0,',','.') }}</h1>
                        </div>
                    </div>
                </div>

                <div class="roww layout-spacing">
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
