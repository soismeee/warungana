@extends('layouts.main')

@section('container')
    <div class="layout-px-spacing">

        <div class="middle-content container-xxl p-0">
            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Menu</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Barang</li>
                    </ol>
                </nav>
            </div>
            <!-- /BREADCRUMB -->
            <div class="row layout-top-spacing">

                <div class="col-xl-8 col-lg-8 col-sm-8  layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <table id="data-barangs" class="table dt-table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="25%">Barang</th>
                                    <th width="20%">Harga</th>
                                    <th width="15%">Kategori</th>
                                    <th width="10%">Jumlah</th>
                                    <th width="20%">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td>Rp. {{ number_format($item->harga_barang,0,',','.') }}</td>
                                        <td>@if ($item->kategori_harga == "eceran")
                                            <span class="badge bg-success">Eceran</span>
                                        @else
                                            <span class="badge bg-danger">Grosir</span>
                                        @endif</td>
                                        <td>{{ $item->jml_barang }} item</td>
                                        <td>Rp. {{ number_format($item->jml_barang*$item->harga_barang,0,',','.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-sm-4  layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-bold">#{{ $transaksi->id }}</h6> <br />
                                    <a href="{{ url('pr') }}/{{ $transaksi->id }}" target="_blank" class="btn btn-sm btn-success">Cetak Struk</a>
                                </div>
                                <hr />
                                <p> Tanggal : {{ date('d/m/Y', strtotime($transaksi->tanggal_transaksi)) }} <br />
                                    Total barang : {{ $transaksi->jumlah_item }} <br />
                                    <strong> Total bayar : {{ number_format($transaksi->total_harga,0,',','.') }} </strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

