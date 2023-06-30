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
                        <li class="breadcrumb-item"><a href="#">Menu</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Barang</li>
                    </ol>
                </nav>
            </div>
            <!-- /BREADCRUMB -->
            <div class="row layout-top-spacing">

                <div class="col-xl-4 col-lg-4 col-sm-4  layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <div class="card">
                            <div class="card-body">
                                <form class="row g-3" id="form-barang">
                                    @csrf
                                    <input type="hidden" name="id" id="id">
                                    <div class="col-12">
                                        <label for="Name" class="form-label">Nama Barang</label>
                                        <input type="text" name="nama_barang" id="nama_barang" class="form-control input" placeholder="Masukan nama pengguna">
                                    </div>
                                    <div class="col-6">
                                        <label for="kategori_id">Kategori Barang</label>
                                        <select class="form-select input" id="kategori_id" name="kategori_id">
                                            <option disabled selected>Pilih</option>
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="stok" class="form-label">Stok</label>
                                        <input type="number" name="stok" id="stok" min="0" class="form-control input" placeholder="Masukan jumlah stok barang">
                                    </div>
                                    <div class="col-6">
                                        <label for="harga_grosir" class="form-label">Harga Grosir</label>
                                        <input type="text" name="harga_grosir" id="harga_grosir" min="0" class="form-control input" placeholder="Masukan harga grosir barang">
                                    </div>
                                    <div class="col-6">
                                        <label for="harga_eceran" class="form-label">Harga Eceran</label>
                                        <input type="text" name="harga_eceran" id="harga_eceran" min="0" class="form-control input" placeholder="Masukan harga eceran barang">
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" id="add-data" class="btn btn-primary">Simpan Data</button>
                                        <button class="btn btn-info text-white" style="display: none" id="update-data">Ubah Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-sm-8  layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <table id="data-barangs" class="table dt-table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="30%">Barang</th>
                                    <th width="25%">kategori</th>
                                    <th width="20%">Harga</th>
                                    <th width="10%">Stok</th>
                                    <th width="10%">#</th>
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
@endsection

@push('js')
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="/assets/src/assets/js/jquery-3.5.1.js"></script>
    <script src="/assets/src/plugins/src/table/datatable/datatables.js"></script>
    <script>

        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
            style: "decimal",
            currency: "IDR"
            }).format(number);
        }

        const table = $('#data-barangs').DataTable({
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
                url:"{{ url('json_b') }}",
                type:"POST",
                data:function(d){
                    d._token = "{{ csrf_token() }}"
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
                    return row.nama_barang
                    }
                },
                {
                    "render": function(data, type, row, meta){
                    return row.kategori_barang.nama_kategori
                    }
                },
                {
                    "render": function(data, type, row, meta){
                    return `GR : Rp. `+rupiah(row.harga_grosir)+`<br /> EC : Rp. `+rupiah(row.harga_eceran)
                    }
                },
                {
                    "render": function(data, type, row, meta){
                    return row.stok
                    }
                },
                {
                    "render": function(data, type, row, meta){
                    return `
                    <a href="javascript:void(0);" class="bs-tooltip" title="Edit" id="edit-data" data-id="`+row.id+`" data-original-title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-edit-2 p-1 br-8 mb-1">
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                        </svg>
                    </a>
                    <a href="javascript:void(0);" class="bs-tooltip hapusdata" data-id="`+row.id+`" title="Delete" data-original-title="Delete">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-trash p-1 br-8 mb-1">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg>
                    </a>`
                    }
                },
            ]
        });

        let harga_grosir = document.getElementById("harga_grosir");
        harga_grosir.addEventListener("keyup", function(e) {
            harga_grosir.value = convertRupiah(this.value, "Rp. ");
        });
        
        let harga_eceran = document.getElementById("harga_eceran");
        harga_eceran.addEventListener("keyup", function(e) {
            harga_eceran.value = convertRupiah(this.value, "Rp. ");
        });

        function convertRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
        }

         // fungsi mengubah tombol simpan
         function tombolSimpan() {
            $('#add-data').removeClass('disabled');
            $('#add-data').html('Simpan Data');
        }

        // fungsi untuk mengubah tombol ubah
        function tombolUbah(){
            $('#update-data').removeClass('disabled');
            $('#update-data').html('Ubah Data');
            $('#update-data').hide();
            $('#add-data').show();
        }

        // fungsi reload table dan reset form input
        function reloadReset(){
            table.ajax.reload();
            document.getElementById("form-barang").reset()
        }

        // template sweetalert
        function sweetAlert(icon, title) {
            Swal.fire({
                icon: icon,
                title: title,
            });
        }

        $(document).on('click', '#add-data', function(e) {
            e.preventDefault();
            $('#add-data').addClass('disabled');
            $('#add-data').html(`<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Loading...`);
            $.ajax({
                type: "POST",
                url: "{{ route('b.index') }}",
                data: $("#form-barang").serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.status == 401) {
                        $('.input').addClass('is-invalid');
                        tombolSimpan()
                    } else {
                        $('.input').removeClass('is-invalid');
                        sweetAlert('success', response.message);
                        tombolSimpan()
                        reloadReset()
                    }
                }
            });
        });

        $(document).on('click', '#edit-data', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#update-data').show();
            $('#add-data').hide();
            $.ajax({
                type: "GET",
                url: "{{ route('b.index') }}/" + id,
                success: function(response) {
                    if (response.status == 401) {
                        sweetAlert('error', response.message);
                    } else {
                        $('.input').removeClass('is-invalid');
                        $('#id').val(response.data.id);
                        $('#nama_barang').val(response.data.nama_barang);
                        $('#kategori_id').val(response.data.kategori_id);
                        $('#stok').val(response.data.stok);
                        harga_grosir.value = convertRupiah(response.data.harga_grosir, "Rp. ");
                        harga_eceran.value = convertRupiah(response.data.harga_eceran, "Rp. ");
                    }
                }
            });
        });

        $(document).on('click', '#update-data', function(e) {
            e.preventDefault();
            $('#update-data').addClass('disabled');
            $('#update-data').html(`<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Loading...`);
            var id = $('#id').val();
            $.ajax({
                type: "PUT",
                url: "{{ route('b.index') }}/" + id,
                data: $('#form-barang').serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.status == 404) {
                        sweetAlert('warning', response.message);
                        tombolUbah();
                    } else {
                        sweetAlert('success', response.message);
                        reloadReset();
                        tombolUbah();
                    }
                }
            });
        });

        $(document).on('click', '.hapusdata', function(e) {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda akan menghapus data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('b.index') }}/" + id,
                        data: {'_token': '{{ csrf_token() }}'},
                        dataType: 'json',
                        success: function(response) {
                            Swal.fire('Deleted!',response.message,'success');
                            table.ajax.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush
