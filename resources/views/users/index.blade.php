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
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
                    </ol>
                </nav>
            </div>
            <!-- /BREADCRUMB -->
            <div class="row layout-top-spacing">

                <div class="col-xl-4 col-lg-4 col-sm-4  layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <div class="card">
                            <div class="card-body">
                                <form class="row g-3" id="form-user">
                                    @csrf
                                    <input type="hidden" name="id" id="id">
                                    <div class="col-12">
                                        <label for="Name" class="form-label">Nama</label>
                                        <input type="text" name="name" id="name" class="form-control input" placeholder="Masukan nama pengguna">
                                    </div>
                                    <div class="col-6">
                                        <label for="Username" class="form-label">Username</label>
                                        <input type="text" name="username" id="username" class="form-control input" placeholder="Buat username pengguna">
                                    </div>
                                    <div class="col-6">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" id="password" class="form-control input" placeholder="Buat password">
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
                        <table id="data-users" class="table dt-table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th width="40%">Name</th>
                                    <th width="40%">username</th>
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

        const table = $('#data-users').DataTable({
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
                url:"{{ url('json_usr') }}",
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
                    return row.name
                    }
                },
                {
                    "render": function(data, type, row, meta){
                    return row.username
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
            document.getElementById("form-user").reset()
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
                url: "{{ route('usr.index') }}",
                data: $("#form-user").serialize(),
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
                url: "{{ route('usr.index') }}/" + id,
                success: function(response) {
                    if (response.status == 401) {
                        sweetAlert('error', response.message);
                    } else {
                        $('.input').removeClass('is-invalid');
                        $('#id').val(response.data.id);
                        $('#name').val(response.data.name);
                        $('#username').val(response.data.username);
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
                url: "{{ route('usr.index') }}/" + id,
                data: $('#form-user').serialize(),
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
                        url: "{{ route('usr.index') }}/" + id,
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
