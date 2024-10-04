import axios from 'axios';
import * as XLSX from 'xlsx'; // Mengimpor XLSX untuk mengolah file Excel

document.addEventListener('DOMContentLoaded', function () {
    const uploadForm = document.getElementById('uploadForm');
    const fileInput = document.getElementById('customFile');
    const fileLabel = document.querySelector('.custom-file-label'); // Elemen untuk menampilkan nama file

    // Event untuk menampilkan nama file yang dipilih
    fileInput.addEventListener('change', function (event) {
        const fileName = event.target.files[0].name; // Mengambil nama file
        fileLabel.textContent = fileName; // Menampilkan nama file
    });

    // Event untuk menangani submit form
    uploadForm.addEventListener('submit', handleFile);
});

function handleFile(event) {
    event.preventDefault(); // Mencegah reload halaman saat submit form

    const fileInput = document.getElementById('customFile');
    const file = fileInput.files[0];
    const reader = new FileReader();

    if (!file) return alert("Silakan pilih file Excel");

    // Membaca file Excel
    reader.onload = function (e) {
        const data = new Uint8Array(e.target.result);
        const workbook = XLSX.read(data, { type: 'array' });

        // Ambil sheet pertama dari file Excel
        const firstSheetName = workbook.SheetNames[0];
        const worksheet = workbook.Sheets[firstSheetName];

        // Konversi sheet ke JSON
        const jsonData = XLSX.utils.sheet_to_json(worksheet);

        // Validasi apakah ada data yang diambil dari file Excel
        if (jsonData.length === 0) {
            return alert('File Excel kosong atau tidak dapat dibaca.');
        }

        // Ambil ID stok opname dari input
        const idStokOpname = document.querySelector('input[name="id_stok_opname"]').value;

        if (!idStokOpname) {
            return alert('ID stok opname diperlukan.');
        }

        // Kirim data JSON ke backend
        axios.post('/admin/stok_barang/import-frontend', {
            data: jsonData,
            id_stok_opname: idStokOpname
        })
        .then(response => {
            const id = idStokOpname; // Menggunakan ID stok opname
            if (response.data.details && response.data.details.length > 0) {
                const detailMessages = response.data.details.join('\n'); // Menggabungkan detail pesan menjadi string
                alert(detailMessages); // Tampilkan hanya detailMessages jika ada data
            } else {
                alert(response.data.message); // Tampilkan hanya pesan jika detailMessages kosong
            }
        
            // Redirect halaman setelah impor
            window.location.replace(`/admin/stok-barang/import/${id}`);
        })
        .catch(error => {
            // Penanganan kesalahan
            if (error.response) {
                // Kesalahan dari server (misalnya, validasi gagal)
                alert(`Error: ${error.response.data.message}`);
            } else {
                // Kesalahan lainnya (jaringan, dll.)
                console.error(error);
                alert('Terjadi kesalahan saat mengimpor dat.');
            }
        });
    };

    reader.readAsArrayBuffer(file); // Membaca file sebagai ArrayBuffer untuk diproses
}
