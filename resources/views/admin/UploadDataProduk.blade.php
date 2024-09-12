@extends('admin.componen.app')

@section('content')
<div class="container">

    
        <!-- Card Frame -->
        <div class="card">
            <div class="card-header">
               <h4> Master Data Produk</h4>
            </div>
            
            <div class="card-body">
                <p><em>Sample excel document</em> <a href="/sampleaddproduk.xlsx" class="btn btn-success btn-sm">Download</a></p>
                <form action="{{ route('unggah_produk') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="custom-file mb-4">
                    <label for="formFileMultiple" class="form-label">Upload File Disini</label>
                    <input class="form-control" type="file"  id="formFileMultiple" name="file_excel" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        </div>
</div>
@endsection
@push('scripts')
@endpush