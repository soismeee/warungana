@extends('layouts.main')
@push('css')

    <!-- choices css -->
    <link href="/assets/src/assets/css/choices.min.css" rel="stylesheet" type="text/css" />
@endpush

@section('container')
    <div class="layout-px-spacing">

        <div class="middle-content container-xxl p-0">

            <div class="row layout-top-spacing">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                        <div class="widget-content widget-content-area br-8">
                            <div class="card">
                                <div class="card-body">
                                        <input type="hidden" name="id" id="id">
                                        <div class="col-12">
                                            <label for="choices-single-default" class="form-label font-size-13 text-muted">Default</label>
                                            <select class="form-control" data-trigger name="choices-single-default" id="barang" placeholder="Pilih barang">
                                                <option selected value="0">Pilih barang</option>
                                                @foreach ($barang as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="d-grid col-6">
                                                <button class="btn btn-lg btn-danger add-transaksi" data-kategori_harga="grosir" data-warna="danger"> GROSIR </button>
                                            </div>
                                            <div class="d-grid col-6">
                                                <button class="btn btn-lg btn-secondary add-transaksi" data-kategori_harga="eceran" data-warna="info"> ECERAN </button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-8">
                            <form class="form-transaksi" id="form-transaksi">
                                @csrf
                                <input type="hidden" id="idtrans">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col" width="5%">
                                                        <a href="#" id="hapusall" class="btn-remove"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                                                </th>
                                                <th scope="col">Barang</th>
                                                <th width="20%" scope="col">Jumlah</th>
                                                <th class="text-center" scope="col">Harga</th>
                                                <th class="text-center" scope="col">Total</th>
                                            </tr>
                                            <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row mt-4" id="rekap" style="display: none">
                                    <div class="d-flex justify-content-between">
                                        <h4><strong>Total</strong></h4>
                                        &nbsp;&nbsp;&nbsp;
                                        <strong class="grand-total"><h4>Rp. 0</h4></strong>
                                    </div>
                                    <div class="col-md-12 d-grid gap-2 mx-auto mt-4 simpan">
                                        <button type="submit" class="btn btn-lg btn-success" id="tombol-simpan">Simpan transaksi</button>
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-12 d-grid gap-2 mx-auto" id="struk">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="/assets/src/assets/js/jquery-3.5.1.js"></script>

    <!-- choices js -->
    <script src="assets/src/assets/js/choices.min.js"></script>
    
    <!-- init js -->
    <script>

        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
            style: "decimal",
            currency: "IDR"
            }).format(number);
        }

        // template sweetalert
        function sweetAlert(icon, title) {
            Swal.fire({
                icon: icon,
                title: title,
            });
        }

        function removeall(){
            arrayBarang = [];
            $('.form-transaksi table tbody').html('');
            $('.grand-total').html('');
            $('#rekap').hide();
            countGrandTotal();
        }

        function countGrandTotal() {
            let grand_total = 0;
            arrayBarang.forEach(val => grand_total = grand_total + parseInt(val.total));
            if (grand_total <= 0) {
                $('#rekap').hide();
            }
            $('.grand-total').html('<h4>Rp.'+rupiah(grand_total)+'</h4><input type="hidden" name="grand_total" value="'+grand_total+'">')
        }

        let arrayBarang = [];
        $(document).on('click', '.add-transaksi', function(e) {
            e.preventDefault();
            let id = $('#barang').val();
            let kategori_harga = $(this).data('kategori_harga');
            let warna = $(this).data('warna');
            if (id == "0") return sweetAlert('error', 'Barang belum dipilih!!');
            if (arrayBarang.filter(item => item.id == id).length > 0) return sweetAlert('warning', 'Barang sudah dipilih!!');

            $.ajax({
                type: "GET",
                url: "{{ url('get_brg') }}/"+id,
                data: {'kategori_harga': kategori_harga, '_token': '{{ csrf_token() }}'},
                dataType: 'json',
                success: function (response) {
                    if (response.status == 401) {
                        sweetAlert('error', response.message);
                    } else {
                        let html =
                            '<tr id="'+response.data.id+'" data-kategori_harga="'+kategori_harga+'" >\
                                <td><a href="#" data-id="'+response.data.id+'" type="button" class="action-icon remove-item"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></td>\
                                <td>'+response.data.nama_barang+'<input type="hidden" name="nama_barang[]" value="'+response.data.nama_barang+'"><input type="hidden" name="kategori_harga[]" value="'+kategori_harga+'"></td>\
                                <td><input type="number" name="jml_barang[]" id="jml_barang" data-id="'+response.data.id+'" data-harga="'+response.data.harga+'" class="form-control jml_barang" value="1" min="1"></td>\
                                <td>Rp. '+rupiah(response.data.harga)+' <span class="badge badge-'+warna+' mb-2 me-4">'+kategori_harga+'</span><input type="hidden" name="harga_barang[]" value="'+response.data.harga+'"></td>\
                                <td>Rp. '+rupiah(response.data.harga)+'</td>\
                            </tr>';
                        arrayBarang.push({
                            id: response.data.id,
                            jumlah: 1,
                            kategori_harga: kategori_harga,
                            total: response.data.harga
                        });
                        let grand_total = 0;
                        arrayBarang.forEach(val => grand_total = grand_total + parseInt(val.total));
                        $('.form-transaksi table tbody').append(html);
                        $('#rekap').show();
                        $('.grand-total').html('<h4>Rp. '+rupiah(grand_total)+'</h4> <input type="hidden" name="grand_total" value="'+grand_total+'">');
                        $('.form-transaksi #idtrans').val(JSON.stringify(arrayBarang));
                    }
                }
            });
        });

        $('.form-transaksi table').on('click', '.btn-remove', function() {
            if (arrayBarang.length == 0) return sweetAlert('warning', 'Tidak ada barang di list!!');
            arrayBarang = [];
            removeall();
        });

        $('.form-transaksi table').on('click', '.remove-item', function() {
            if (arrayBarang.length == 0) return sweetAlert('error', 'Barang belum dipilih!!');
            $(this).parent().parent().remove();
            let id = $(this).data('id');
            let kategori_harga = $(this).data('kategori_harga');
            arrayBarang = arrayBarang.filter(e => e.id != id && e.kategori_harga != kategori_harga);
            $('.form-transaksi').val(JSON.stringify(arrayBarang));
            countGrandTotal();
        });

        $(document).on('change', '.jml_barang', function() {
            let id = $(this).data('id');
            let jumlah = $(this).val();
            let harga = $(this).data('harga');
            let total = jumlah * harga;
            $('.form-transaksi #' + id + ' td:last').html('Rp.' + rupiah(total));
            objIndex = arrayBarang.findIndex((obj => obj.id == id));
            arrayBarang[objIndex].jumlah = jumlah;
            arrayBarang[objIndex].total = total;
            countGrandTotal();
        });

        $('#form-transaksi').on('submit', function(e){
            e.preventDefault();
            $('#tombol-simpan').addClass('disabled');
            $('#tombol-simpan').html(`<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Loading...`);
            $.ajax({
                url: "{{ url('save') }}",
                type: "POST",
                data: $('#form-transaksi').serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.status == 401) {
                        sweetAlert('error', response.errors);
                        removeall();
                    } else {
                        // sweetAlert('success', response.message);
                        removeall();
                        $('#tombol-simpan').removeClass('disabled');
                        $('#tombol-simpan').html('Simpan Transaksi');
                        $('#struk').html(`<a href="#" class="btn btn-lg btn-primary" id="cetak-struk" data-value="`+response.trans_id+`">Cetak Struk</a>`)
                    }
                }
            });
        });

        $(document).on('click', '#cetak-struk', function(e){
            e.preventDefault();
            var value = $(this).data('value');
            window.open('/pr/'+value, '_blank');
            $('#cetak-struk').hide();
        });

        $(document).ready(function () {
            var e = document.querySelectorAll("[data-trigger]");
            for (i = 0; i < e.length; ++i) {
                var a = e[i];
                new Choices(a,{
                    placeholderValue: "This is a placeholder set in the config",
                    searchPlaceholderValue: "This is a search placeholder"
                })
            }
            new Choices("#choices-single-no-sorting",{
                shouldSort: !1
            }),
            new Choices("#choices-multiple-remove-button",{
                removeItemButton: !0
            }),
            new Choices(document.getElementById("choices-multiple-groups")),
            new Choices(document.getElementById("choices-text-remove-button"),{
                delimiter: ",",
                editItems: !0,
                maxItemCount: 5,
                removeItemButton: !0
            }),
            new Choices("#choices-text-unique-values",{
                paste: !1,
                duplicateItemsAllowed: !1,
                editItems: !0
            }),
            new Choices("#choices-text-disabled",{
                addItems: !1,
                removeItems: !1
            }).disable()
        });

    </script>
@endpush
