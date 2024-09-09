@extends('user.componen.app')

@section('content')
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href={{route('dashboard_user')}}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
        <li class="breadcrumb-item"><a href={{route('dashboard_user')}}>Pengelolaan Stok Opname</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
    </ol>
</nav>

<div class="col-xl-8 col-lg-6 col-md-6 col-sm-12 col-12 mt-3" style="margin-bottom:24px;">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">                                
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Tambah Data</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area" style="height: 400px;">
                                <form action="{{ route('user.storeopname') }}" method="POST">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="nomorDokumen">Nomor Dokumen</label>
                                    <input type="text" class="form-control" id="nomorDokumen" name="nomor_dokumen" required>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="tanggalOpname">Tanggal Stok Opname</label>
                                    <input id="basicFlatpickr" name="tanggal_opname" value="" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Pilih Tanggal.." >

                                </div>

                                <div class="form-group mb-4">
                                    <label for="gudangSelect">Lokasi Gudang</label>
                                    <select class="form-control  basic" id="gudangSelect" name="id_gudang" required>
                                        @foreach ($gudangs as $gudang)
                                            <option value="{{ $gudang->id }}">{{ $gudang->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>       
                                        <button class="btn btn-primary" style="margin-left: 0px">
                                        Submit</button>
                                <a href="{{ route('dashboard_user') }}" type="button" class="btn btn-outline-danger"
                                    style="margin-left: 5px"><i class="ti ti-arrow-back"></i> Cancel</a>
                                </div>
                              </form>
                            </div>
                        
@endsection

@push('script')

<script>
var f1 = flatpickr(document.getElementById('basicFlatpickr'));

var ss = $(".basic").select2({
    tags: true,
});
</script>

@endpush