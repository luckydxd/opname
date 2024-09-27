<?php

namespace App\DataTables;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DataProdukDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query));
        
            // ->addColumn('action', function ($row) {
            //     return '<a href="' . route('produk.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>
            //             <a href="' . route('produk.destroy', $row->id) . '" class="btn btn-sm btn-danger">Delete</a>';
            // })
            
            // ->setRowId('id');
            // ->addColumn('nama', function ($row) {
            //     return $row->nama;
            // });
            // ->addColumn('kode', function ($row) {
            //     return $row->kode;
            // });
            // ->addColumn('kuantitas', function ($row) {
            //     return $row->kuanitas ?? 'N/A'; // Menambahkan data default jika tidak tersedia
            // });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Produk $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the HTML builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('dataproduk-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                
                Button::make('reload'),
                Button::make('') // Tambahkan tombol custom 'Add'

                    ->text('<i class="bi bi-file-earmark-spreadsheet"></i>Add Produk') // Teks dan iko
                    ->text('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16">
  <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5zM3 12v-2h2v2zm0 1h2v2H4a1 1 0 0 1-1-1zm3 2v-2h3v2zm4 0v-2h3v1a1 1 0 0 1-1 1zm3-3h-3v-2h3zm-7 0v-2h3v2z"/>
</svg>') // Teks dan ikon tombol

                    ->action('function(){ window.location.href = "' . route('uploadForm_produk') . '"; }')//aksi
                    ->addClass('btn btn-success'), // Kelas CSS untuk styling
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            // Column::make('id'),
            Column::make('nama'),
            Column::make('kode')
            // Column::make ('kuantitas')
            // Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'DataProduk_' . date('YmdHis');
    }
}
