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
                            <div class="custom-file-container" data-upload-id="mySecondImage">
                                <label><a href="javascript:void(0)" class="custom-file-container__image-clear"
                                        title="Clear Image"></a></label>
                                <label class="custom-file-container__custom-file">
                                    <input type="file" id="customFile"
                                        class="custom-file-container__custom-file__custom-file-input" multiple>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                </label>
                                <div class="custom-file-container__image-preview"></div>
                            </div>

                            <input type="hidden" name="id_stok_opname" value="{{ $stokOpname->id }}">

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

                            <th>Kuantitas</th>
                            <th>action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link href="{{ asset('demo5/assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('demo5/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@push('scripts')
    <script src="{{ asset('demo5/plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
    @vite('resources/js/importExcel.js')
    <script type="text/javascript">
        var secondUpload = new FileUploadWithPreview('mySecondImage')
        $(function() {
            $('#stok-barang-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('stok-barangs-get') }}", // Menggunakan nama route yang benar
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'produk',
                        name: 'produk'
                    },
                    {
                        data: 'kuantitas',
                        name: 'kuantitas'
                    },
                    {
                        data: 'action',
                        name: 'action',
                    }
                ],
                dom: 'lfrtip' // Menentukan elemen DOM untuk ditampilkan (menghilangkan tombol-tombol ekspor)
            });
        });
    </script>
@endpush
