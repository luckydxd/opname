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
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                return '<a href="' . route('produk.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>
                        <a href="' . route('produk.destroy', $row->id) . '" class="btn btn-sm btn-danger">Delete</a>';
            })
            ->setRowId('id')
            ->addColumn('nama', function ($row) {
                return $row->nama;
            })
            ->addColumn('kode', function ($row) {
                return $row->kode;
            });
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
                Button::make('reset'),
                Button::make('reload'),
                Button::make('') // Tambahkan tombol custom 'Add'
                    ->text('<i class="bi bi-file-earmark-spreadsheet"></i>') // Teks dan ikon tombol
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

            Column::make('id'),
            Column::make('nama'),
            Column::make('kode'),
            Column::computed('action')
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
