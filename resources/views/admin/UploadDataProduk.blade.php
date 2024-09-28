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
            <div class="row my-3">
                <div class="col-6">
                    <form id="uploadForm" enctype="multipart/form-data" onsubmit="handleFile(event)">
                        <div class="custom-file mb-4">
                            <input type="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                           
                            {{-- <input type="hidden" name="id_stok_opname" value="{{ $stokOpname->id }}"> --}}
                        </div>
                        <button type="submit" class="btn btn-primary mt-0">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script>

document.getElementById('customFile').addEventListener('change', function(event) {
        var fileName = event.target.files[0].name; // Mengambil nama file
        var nextSibling = event.target.nextElementSibling;
        nextSibling.innerText = fileName; // Mengubah teks pada label
    });

    function handleFile(event) {
        event.preventDefault(); // Mencegah form dikirim secara tradisional

        const fileInput = document.getElementById('customFile');
        const file = fileInput.files[0];

        if (!file) {
            alert('Please select a file first!');
            return;
        }

        const reader = new FileReader();

        reader.onload = function(event) {
            const data = new Uint8Array(event.target.result);
            const workbook = XLSX.read(data, { type: 'array' });

            // Asumsi sheet pertama digunakan
            const firstSheet = workbook.Sheets[workbook.SheetNames[0]];

            // Konversi sheet ke format JSON
            const jsonData = XLSX.utils.sheet_to_json(firstSheet, { header: 1 });

            // Konversi ke format array objek dengan properti Kode dan Nama
            const formattedData = jsonData.slice(1).map(row => ({
                'Kode': row[0],
                'Nama': row[1]
            }));

            // Kirim data ke backend menggunakan fetch
            fetch('{{ route('unggah_produk') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ data: formattedData })
            })
            .then(response => response.json())
            .then(result => {
    if (result.message) {
        alert(result.message + (result.duplicates ? '\n' + result.duplicates.join('\n') : ''));
        window.location.replace(`{{route ('data_produk') }}`);
    }
})

            .catch(error => console.error('Error:', error));
        };

        reader.readAsArrayBuffer(file);
    }
</script>
@endsection
