import axios from 'axios';
import * as XLSX from 'xlsx'; // Mengimpor XLSX untuk mengolah file Excel

document.addEventListener('DOMContentLoaded', function () {
    const uploadForm = document.getElementById('uploadForm');
    
    uploadForm.addEventListener('submit', handleFile);
});

function handleFile(event) {
    event.preventDefault(); // Mencegah reload halaman saat submit form

    const fileInput = document.getElementById('customFile'); // Pastikan ID sesuai dengan elemen input file
    const file = fileInput.files[0];
    const reader = new FileReader();

    if (!file) return alert("Silakan pilih file Excel");

    reader.onload = function(e) {
        const data = new Uint8Array(e.target.result);
        const workbook = XLSX.read(data, { type: 'array' });

        // Ambil sheet pertama
        const firstSheetName = workbook.SheetNames[0];
        const worksheet = workbook.Sheets[firstSheetName];

        // Konversi sheet ke JSON
        const jsonData = XLSX.utils.sheet_to_json(worksheet);

        // Kirim data JSON ke backend
        axios.post('/admin/stok_barang/import-frontend', {
            data: jsonData,
            id_stok_opname: document.querySelector('input[name="id_stok_opname"]').value
        })
        .then(response => {
            const id = document.querySelector('input[name="id_stok_opname"]').value;
            alert(response.data.message);
            window.location.replace(`/admin/stok-barang/import/${id}#uploadForm`);
        })
        
        .catch(error => {
            console.error(error);
            alert('Terjadi kesalahan saat mengimpor data.');
        });
    };

    reader.readAsArrayBuffer(file);
}
