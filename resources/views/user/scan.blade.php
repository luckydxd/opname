@extends('user.componen.app')
@section('content')


<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href={{route('dashboard_user')}}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></a></li>
        <li class="breadcrumb-item"><a href={{route('dashboard_user')}}>Pengelolaan Stok Opname</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Stok Opname</li>
    </ol>
</nav>

<div class="row layout-top-spacing">
                    <div class="col-xl-5 col-lg-6 col-md-6 mb-4">
                        <div class="card b-l-card-1 h-100" style="-webkit-box-shadow: 0 4px 6px 0 rgba(85, 85, 85, 0.08), 0 1px 20px 0 rgba(0, 0, 0, 0.07), 0px 1px 11px 0px rgba(0, 0, 0, 0.07);-moz-box-shadow: 0 4px 6px 0 rgba(85, 85, 85, 0.08), 0 1px 20px 0 rgba(0, 0, 0, 0.07), 0px 1px 11px 0px rgba(0, 0, 0, 0.07); box-shadow: 0 4px 6px 0 rgba(85, 85, 85, 0.08), 0 1px 20px 0 rgba(0, 0, 0, 0.07), 0px 1px 11px 0px rgba(0, 0, 0, 0.07);">
                            <div class="card-body">
                            <section class="container" id="demo-content">
     
     
     <div>
       <a class="button btn btn-outline-primary mb-3" id="startButton">Start</a>
       <a class="button btn btn-outline-danger mb-3" id="resetButton">Reset</a>
     </div>

     <div>
       <video id="video" width="300" height="200" style="border: 1px solid gray"></video>
     </div>

     <div id="sourceSelectPanel" style="display:none">
       <label for="sourceSelect">Change video source:</label>
       <select  class="form-control  basic" id="sourceSelect" style="max-width:400px">
       </select>
     </div>

     <label class="mt-3">Hasil:</label>
     <pre><code id="result"></code></pre>

     
   </section>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-7 col-lg-6 col-md-6 col-sm-12 col-12" style="margin-bottom:24px;">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">                                
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Input Detail Stok Opname</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area" style="height: 400px;">
                            <form action="{{ route('user.storeqty', ['id' => $stokOpname->id]) }}" method="POST">
    @csrf
    <input type="hidden" name="id_stok_opname" value="{{ $stokOpname->id }}">
    <div class="form-group mb-4">
        <label for="codeSelect">Code</label>
        <div class="input-group">
            <input type="text" id="codeInput" class="form-control" aria-describedby="basic-addon2" required readonly>
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">
                    <!-- SVG Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512">
                        <path d="M24 32C10.7 32 0 42.7 0 56L0 456c0 13.3 10.7 24 24 24l16 0c13.3 0 24-10.7 24-24L64 56c0-13.3-10.7-24-24-24L24 32zm88 0c-8.8 0-16 7.2-16 16l0 416c0 8.8 7.2 16 16 16s16-7.2 16-16l0-416c0-8.8-7.2-16-16-16zm72 0c-13.3 0-24 10.7-24 24l0 400c0 13.3 10.7 24 24 24l16 0c13.3 0 24-10.7 24-24l0-400c0-13.3-10.7-24-24-24l-16 0zm96 0c-13.3 0-24 10.7-24 24l0 400c0 13.3 10.7 24 24 24l16 0c13.3 0 24-10.7 24-24l0-400c0-13.3-10.7-24-24-24l-16 0zM448 56l0 400c0 13.3 10.7 24 24 24l16 0c13.3 0 24-10.7 24-24l0-400c0-13.3-10.7-24-24-24l-16 0c-13.3 0-24 10.7-24 24zm-64-8l0 416c0 8.8 7.2 16 16 16s16-7.2 16-16l0-416c0-8.8-7.2-16-16-16s-16 7.2-16 16z"/>
                    </svg>
                </span>
            </div>
        </div>
    </div>
                                  <div class="form-group mb-4">
                                      <label for="produkSelect">Produk</label>
                                      <select class="form-control basic" id="produkSelect" name="id_produk" required readonly>
                                          <option value="">-- Nama Produk --</option>
                                          @foreach ($produks as $produk)
                                              <option value="{{ $produk->id }}" data-kode="{{ $produk->kode }}">{{ $produk->nama }}</option>
                                          @endforeach
                                      </select>
                                  </div>

                                        <div class="form-group mb-4">
                                            <label for="fisik_all">QTY</label>
                                            <input type="text" name="fisik_all" class="form-control" id="fisik_all" >
                                        </div>
           
                                        <button class="btn btn-primary" style="margin-left: 0px">
                                        Submit</button>
                                <a href="{{ route('dashboard_user') }}" type="button" class="btn btn-outline-danger"
                                    style="margin-left: 5px"><i class="ti ti-arrow-back"></i> Cancel</a>
                                </div>
                                    </form>
                            </div>
                        </div>
                    </div>

                    <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Detail Stok Opname</h4>
                                    </div>          
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="table-responsive">
                                    <table id="datatable" class="border-top-0 table table-bordered border-bottom">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nomor Kode</th>
                                    <th class="column-tanggal text-center">Nama Barang</th>
                                    <th class="text-center">Kuantitas</th>
                                    <th class="text-center">Opsi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                            </tbody>
                        </table>
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

            var idStokOpname = window.location.pathname.split("/").pop();

            let table = $("#datatable").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/user/scan/' + idStokOpname + '/datatable',
                },
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
                                <a href="{{route('user.editqty', ':id')}}" class="btn btn-info mr-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
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
                        data: 'kode'
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'fisik_all'
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
                            url: "{{ route('user.deleteqty', ':id') }}".replace(':id', id),
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


<script src="https://unpkg.com/@zxing/library@0.18.6/umd/index.min.js"></script>
<script type="text/javascript">
    window.addEventListener('load', function () {
        let selectedDeviceId;
        const codeReader = new ZXing.BrowserMultiFormatReader();
        console.log('ZXing code reader initialized');

        codeReader.listVideoInputDevices()
            .then((videoInputDevices) => {
                const sourceSelect = document.getElementById('sourceSelect');
                if (videoInputDevices.length > 0) {
                    selectedDeviceId = videoInputDevices[0].deviceId;

                    videoInputDevices.forEach((element) => {
                        const sourceOption = document.createElement('option');
                        sourceOption.text = element.label || `Camera ${sourceSelect.length + 1}`;
                        sourceOption.value = element.deviceId;
                        sourceSelect.appendChild(sourceOption);
                    });

                    sourceSelect.onchange = () => {
                        selectedDeviceId = sourceSelect.value;
                    };

                    const sourceSelectPanel = document.getElementById('sourceSelectPanel');
                    sourceSelectPanel.style.display = 'block';
                }

                // Mulai scanning
                document.getElementById('startButton').addEventListener('click', () => {
                    codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
                        if (result) {
                            console.log(result);
                            document.getElementById('result').textContent = result.text; // Tampilkan hasil di <pre>

                            // Set nilai input form
                            document.getElementById('codeInput').value = result.text;

                            // Cari dan pilih produk yang sesuai berdasarkan kode
                            const scannedKode = result.text.trim(); // Trim whitespace
                            const produkSelect = document.getElementById('produkSelect');
                            const optionToSelect = produkSelect.querySelector(`option[data-kode="${scannedKode}"]`);

                            if (optionToSelect) {
                                produkSelect.value = optionToSelect.value;
                            } else {
                                alert('Produk dengan kode ' + scannedKode + ' tidak ditemukan.');
                                // Reset produkSelect jika diperlukan
                                produkSelect.value = "";
                            }
                        }
                        if (err && !(err instanceof ZXing.NotFoundException)) {
                            console.error(err);
                            document.getElementById('result').textContent = err;
                        }
                    });
                    console.log(`Started continuous decode from camera with id ${selectedDeviceId}`);
                });

                // Reset scanner
                document.getElementById('resetButton').addEventListener('click', () => {
                    codeReader.reset();
                    document.getElementById('result').textContent = '';
                    document.getElementById('codeInput').value = ''; // Reset input form
                    const produkSelect = document.getElementById('produkSelect');
                    produkSelect.value = ""; // Reset produkSelect
                    console.log('Reset.');
                });

            })
            .catch((err) => {
                console.error(err);
            });
    });
</script>
@endpush
