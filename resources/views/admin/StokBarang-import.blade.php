@extends('admin.componen.app')
@section('content')
    <div class="container my-3 ">
        <div class="card my-2">
            <div class="card-header">
                Master Data Stok Opname
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="fst-italic">Sample excel Document</span>
                        <a href="{{ asset('samplestokbarang.xlsx') }}" class="btn btn-success btn-sm">Download</a>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-6">
                        <form id="uploadForm" enctype="multipart/form-data" onsubmit="handleFile(event)">
                            <div class="custom-file mb-4">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <input type="hidden" name="id_stok_opname" value="{{ $stokOpname->id }}">
                            </div>
                            <button type="submit" class="btn btn-primary mt-0">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card my-2">
            <div class="card-body">
                <table class="table table-bordered" id="stok-barang-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Nama Stok Opname</th>
                            <th>Kuantitas</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
@endpush

@push('scripts')
    @vite('resources/js/importExcel.js')
    <script type="text/javascript">
        $(function() {
            $('#stok-barang-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('stok-barangs.get') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'produk',
                        name: 'produk'
                    },
                    {
                        data: 'stok_opname',
                        name: 'stok_opname'
                    },
                    {
                        data: 'kuantitas',
                        name: 'kuantitas'
                    },
                ]
            });
        });
    </script>
@endpush
