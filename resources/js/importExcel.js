import axios from 'axios';
import * as XLSX from 'xlsx'; // Mengimpor XLSX untuk mengolah file Excel

        document.addEventListener('DOMContentLoaded', function() {
            const uploadForm = document.getElementById('uploadForm');
            const fileInput = document.getElementById('customFile');

            // Event untuk menampilkan nama file yang diunggah
            fileInput.addEventListener('change', function(event) {
                const fileName = event.target.files[0].name; // Mengambil nama file
                const nextSibling = event.target.nextElementSibling;
                nextSibling.innerText = fileName; // Mengubah teks pada label
            });

            // Event untuk submit form
            uploadForm.addEventListener('submit', handleFile);
        });

        function handleFile(event) {
            event.preventDefault(); // Mencegah reload halaman saat submit form

            const fileInput = document.getElementById('customFile');
            const file = fileInput.files[0];
            const reader = new FileReader();

            if (!file) return alert("Silakan pilih file Excel");

            reader.onload = function(e) {
                const data = new Uint8Array(e.target.result);
                const workbook = XLSX.read(data, {
                    type: 'array'
                });

                // Ambil sheet pertama
                const firstSheet = workbook.Sheets[workbook.SheetNames[0]];

                // Konversi sheet ke JSON
                const jsonData = XLSX.utils.sheet_to_json(firstSheet, {
                    header: 1
                });

                // Format data menjadi array objek dengan Kode dan Nama
                const formattedData = jsonData.slice(1).map(row => ({
                    'Kode': row[0], // Asumsikan kolom pertama adalah Kode
                    'Nama': row[1], // Asumsikan kolom kedua adalah Nama
                    'Kuantitas': row[2] // Tambahkan kolom ketiga jika ada Kuantitas
                }));

                // Kirim data JSON ke backend
                axios.post('/admin/stok_barang/import-frontend', {
                        data: formattedData,
                        id_stok_opname: document.querySelector('input[name="id_stok_opname"]').value
                    })
                    .then(response => {
                        const id = document.querySelector('input[name="id_stok_opname"]').value;

                        // Tampilkan pesan sukses
                        alert(response.data.message + (response.data.duplicates ? '\n' + response.data.duplicates
                            .join('\n') : ''));

                        // Redirect halaman setelah impor berhasil
                        window.location.replace(`/admin/stok-barang/import/${id}`);
                    })
                    .catch(error => {
                        // Cek apakah error berasal dari backend
                        if (error.response) {
                            // Jika ada pesan error spesifik dari backend
                            if (error.response.status === 422) {
                                // Jika validasi gagal (HTTP 422)
                                alert("Validasi gagal: " + error.response.data.errors);
                            } else if (error.response.status === 409) {
                                // Jika ada kode produk yang sudah ada (HTTP 409)
                                alert("Kode produk sudah ada di database.");
                            } else {
                                // Kesalahan lain dari server (HTTP 500 atau lainnya)
                                alert("Terjadi kesalahan di server: " + error.response.data.message);
                            }
                        } else {
                            // Jika kesalahan berasal dari jaringan atau hal lain
                            console.error(error);
                            alert('Terjadi kesalahan saat mengimpor data.');
                        }
                    });
            };

            reader.readAsArrayBuffer(file);
        }