@extends('user.componen.app')

@section('content')
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href={{route('dashboard_user')}}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
        <li class="breadcrumb-item"><a href={{route('dashboard_user')}}>Pengelolaan Stok Opname</a></li>
        <li class="breadcrumb-item"><a href={{ route('user.scan', $DetailStokOpname->id_stok_opname)}}>Detail Stok Opname</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Detail Stok Opname</li>
    </ol>
</nav>


<div class="col-xl-8 col-lg-6 col-md-6 col-sm-12 col-12 mt-3">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">                                
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Edit Detail Stok Opname</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area" style="height: 400px;">
                                <form action="{{ route('user.update.qty',$DetailStokOpname->id) }}" method="POST" >           
                                 @csrf
                                

                                <input type="hidden" name="id_stok_opname" value="{{ $DetailStokOpname->id_stok_opname }}" required>
                                <div class="form-group mb-4">
                                    <label for="kodeProduk">Nomor Kode</label>
                                    <input type="text" class="form-control" id="kodeProduk" value="{{$item->kode}}" readonly >
                                </div>

                                <div class="form-group mb-4">
                                    <label for="namaProduk">Nama Barang</label>
                                    <input type="text" class="form-control" id="namaProduk" value="{{$item->nama}}" readonly required>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="fisik_all">QTY</label>
                                    <input type="text" class="form-control" id="fisik_all" name="fisik_all" value="{{$item->fisik_all}}"  required>
                                </div>
   
                                        <button class="btn btn-primary" style="margin-left: 0px">
                                        Submit</button>
                                        <a href="{{ route('user.scan', $DetailStokOpname->id_stok_opname)}}" type="button" class="btn btn-outline-danger"
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