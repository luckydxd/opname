@extends('user.componen.app')

@section('content')
    <nav class="breadcrumb-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg></a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Pengelolaan Stok Opname</a></li>
            <!-- <li class="breadcrumb-item active" aria-current="page">UI Kit</li> -->
        </ol>
    </nav>




    <div class="col-lg-12 col-md-12 mt-3 layout-spacing">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('user.addopname') }}" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Tambah Data
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-arrow-left alert-icon-left alert-light-primary mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg
                        xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-x close">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg></button>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-check">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <strong>Berhasil!</strong> {{ session('success') }}
            </div>
        @endif

        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Data Stok Opname</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive">
                    <table id="datatable" class="border-top-0 table table-bordered border-bottom">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nomor Dokumen</th>
                                <th class="column-tanggal text-center">Tanggal Stok Opname</th>
                                <th class="text-center">Lokasi</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let table = $("#datatable").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user.datatable') }}",
                columnDefs: [{
                        targets: 0,
                        render: function(data, type, full, meta) {
                            return meta.row + 1;
                        },
                    },
                    {
                        targets: 3,
                        render: function(data, type, full, meta) {
                            return full.gudang ? full.gudang.nama : '-';
                        },
                    },
                    {
                        targets: 4,
                        render: function(data, type, full, meta) {
                            let btn = `
                            <div class="btn-list">
                                <a href="{{ route('user.scan', ':id') }}" class="btn btn-info mr-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                </a>
                                <button class="btn btn-danger btn-delete" data-id=":id"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                 </button>
                            </div>
                        `;
                            btn = btn.replaceAll(':id', data);
                            return btn;
                        },
                    },
                ],
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'nomor_dokumen'
                    },
                    {
                        data: 'tanggal_opname'
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'id'
                    }
                ],
                language: {
                    searchPlaceholder: 'Cari...',
                    sSearch: '',
                }
            });
            $('#datatable').on('click', '.btn-delete', function() {
                let deleteId = $(this).data('id');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Anda tidak akan dapat mengembalikan ini!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    willOpen: () => {
                        const confirmButton = Swal.getConfirmButton();
                        const cancelButton = Swal.getCancelButton();

                        confirmButton.style.fontSize =
                            '18px'; // Ukuran font untuk tombol konfirmasi
                        confirmButton.style.padding = '12px 24px'; // Padding tombol konfirmasi
                        confirmButton.style.borderRadius =
                            '6px'; // Border radius tombol konfirmasi

                        cancelButton.style.fontSize = '18px'; // Ukuran font untuk tombol batal
                        cancelButton.style.padding = '12px 24px'; // Padding tombol batal
                        cancelButton.style.borderRadius = '6px'; // Border radius tombol batal
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('user/dashboard') }}/" + deleteId,

                            type: 'DELETE',
                            success: function(result) {
                                Swal.fire({
                                    title: 'Terhapus!',
                                    text: 'Item Anda telah dihapus.',
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK',
                                    willOpen: () => {
                                        const confirmButton = Swal
                                            .getConfirmButton();
                                        confirmButton.style.fontSize =
                                            '18px'; // Ukuran font untuk tombol OK
                                        confirmButton.style.padding =
                                            '10px 50px'; // Padding tombol OK
                                        confirmButton.style.borderRadius =
                                            '6px'; // Border radius tombol OK
                                    }
                                });
                                table.ajax.reload(null, false);
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    title: 'Kesalahan!',
                                    text: 'Kesalahan saat menghapus data: ' +
                                        xhr.statusText,
                                    icon: 'error',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK',
                                    willOpen: () => {
                                        const confirmButton = Swal
                                            .getConfirmButton();
                                        confirmButton.style.fontSize =
                                            '18px'; // Ukuran font untuk tombol OK
                                        confirmButton.style.padding =
                                            '10px 50px'; // Padding tombol OK
                                        confirmButton.style.borderRadius =
                                            '6px'; // Border radius tombol OK
                                    }
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
