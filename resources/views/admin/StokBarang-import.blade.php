@extends('admin.componen.app')
@section('content')
    <div class="container my-3">
        <div class="card">
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
    </div>
@endsection

@push('scripts')
    @vite('resources/js/importExcel.js')
@endpush
