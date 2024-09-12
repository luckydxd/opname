<?php

namespace App\DataTables;

use App\Models\Gudang;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DataGudangDataTable extends DataTable
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
                // Tombol untuk mengedit data Gudang
                $editUrl = route('data_gudang_edit', $row->id); // Sesuaikan dengan route edit gudang
                return "<a href='{$editUrl}' class='btn btn-sm btn-warning rounded-circle'><i class='bi bi-gear'></i></a>";
            })

            ->setRowId('id')
            ->addColumn('nama', function ($row) {
                return $row->nama; // Menampilkan nama gudang
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Gudang $model): QueryBuilder
    {
        // Mengambil semua data dari tabel 'gudangs'
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the HTML builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('gudang-table') // ID tabel HTML
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('reset'),
                Button::make('reload'),
                Button::make('add')
                    ->text('<i class="bi bi-plus"></i> Add Gudang') // Teks dan ikon tombol
                    ->action('function(){ window.location.href = "' . route('data_gudang_add') . '"; }') // Aksi tombol untuk redirect
                    ->addClass('btn btn-success'), // Kelas CSS untuk styling
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID'), // Menampilkan ID gudang
            Column::make('nama')->title('Nama Gudang'), // Menampilkan nama gudang
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->title('Aksi'), // Kolom aksi
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Gudang_' . date('YmdHis');
    }
}
