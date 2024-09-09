@extends('user.componen.app')

@section('content')
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Pengelolaan Stok Opname</a></li>
        <!-- <li class="breadcrumb-item active" aria-current="page">UI Kit</li> -->
    </ol>
</nav>


<div class="col-lg-12 col-md-12 mt-3 layout-spacing">
<div class="d-flex justify-content-end mb-3">
                                    <a href="" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                        Tambah Data
                                    </a>
                                    </div>
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
    
                                        <h5 class="mt-2">Data Stok Opname</h5>
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
                        targets: 4,
                        render: function(data, type, full, meta) {
                            let btn = `
                            <div class="btn-list">
                                <a href="" class="btn btn-info mr-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
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
                        data: 'lokasi'
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
        });

           
    </script>
@endpush
