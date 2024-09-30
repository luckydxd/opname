<?php

namespace App\DataTables;

use App\Models\DetailStokOpname;
use App\Models\StokBarang;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DetailOpnameDataTable extends DataTable
{
    protected $idStokOpname;

    // Constructor untuk menerima id_stok_opname
    public function __construct($idStokOpname)
    {
        $this->idStokOpname = $idStokOpname;
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                $settingsUrl = "";

                return "
                    <a class='btn btn-sm btn-warning rounded-circle' href='{$settingsUrl}' title='Pengaturan'>
                        <i class='bi bi-gear'></i>
                    </a>
                ";
            })
            ->setRowId('id');
    }

    public function query(DetailStokOpname $model): QueryBuilder
    {
        // Ambil data detail opname terkait berdasarkan id_stok_opname
        $details = $model->newQuery()->where('id_stok_opname', $this->idStokOpname)->get();

        // Update kolom `fisik_all`, `selisih`, dan `keterangan`
        foreach ($details as $detail) {
            // Cari stok barang terkait berdasarkan `id_stok_opname` dan dapatkan kuantitasnya
            $stokBarang = StokBarang::where('id_stok_opname', $detail->id_stok_opname)
                ->where('kode_produk', $detail->kode_produk) // Sesuaikan pencarian stok barang berdasarkan kebutuhan
                ->first();

            // Jika stok barang ditemukan, perbarui `fisik_all`
            if ($stokBarang) {
                $detail->kuantitas = $stokBarang->kuantitas;
            } else {
                $detail->kuantitas = 0; // Jika stok barang tidak ditemukan, atur `fisik_all` ke 0
            }

            // Hitung selisih antara `kuantitas` dan `fisik_all`
            $detail->selisih = $detail->kuantitas - $detail->fisik_all;

            // Set keterangan berdasarkan nilai selisih
            $detail->keterangan = $detail->selisih != 0 ? 'tidak balance' : 'balance';

            // Simpan perubahan
            $detail->save();
        }

        // Kembalikan query setelah diperbarui
        return $model->newQuery()->where('id_stok_opname', $this->idStokOpname);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('detailopname-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('reload'),
                Button::make('excel')->text('Export to Excel')->action('function() { window.location.href = "/export-excel/' . $this->idStokOpname . '"; }')
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('kode_produk')->title('Kode Produk'), // Gantilah dengan kolom yang benar
            Column::make('kuantitas')->title('Kuantitas'),
            Column::make('fisik_all')->title('Fisik All'),
            Column::make('selisih')->title('Selisih'),
            Column::make('keterangan')->title('Keterangan'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    public function exportToExcel()
    {
        $details = DetailStokOpname::where('id_stok_opname', $this->idStokOpname)->get();

        // Membuat spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Mengatur header kolom
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Kode Produk');
        $sheet->setCellValue('C1', 'Kuantitas');
        $sheet->setCellValue('D1', 'Fisik All');
        $sheet->setCellValue('E1', 'Selisih');
        $sheet->setCellValue('F1', 'Keterangan');

        $row = 2; // Baris mulai untuk data
        foreach ($details as $detail) {
            $sheet->setCellValue('A' . $row, $detail->id);
            $sheet->setCellValue('B' . $row, $detail->kode_produk);
            $sheet->setCellValue('C' . $row, $detail->kuantitas);
            $sheet->setCellValue('D' . $row, $detail->fisik_all);
            $sheet->setCellValue('E' . $row, $detail->selisih);
            $sheet->setCellValue('F' . $row, $detail->keterangan);
            $row++;
        }

        // Menyimpan file Excel
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Detail_Opname_' . date('Y-m-d') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    protected function filename(): string
    {
        return 'detailOpname_' . date('YmdHis');
    }
}
