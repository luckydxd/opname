<?php

namespace App\DataTables;

use App\Models\StokOpname;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class stokOpnameDataTable extends DataTable
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
                $url = route('stok_opname_import', $row->id); // Ganti 'nama.route' dengan nama route yang sesuai
                return "<a class='btn btn-sm btn-warning rounded-circle' href='{$url}'><i class='bi bi-gear'></i></a>";
            })
            ->setRowId('id')
            ->addColumn('gudang_nama', function ($row) {
                return $row->gudang ? $row->gudang->nama : '-';
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(StokOpname $model): QueryBuilder
    {
        // Eager load 'gudang' relationship to avoid N+1 query problem
        return $model->newQuery()->with('gudang');
    }

    /**
     * Optional method if you want to use the HTML builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('stokopname-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([

                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id'),
            Column::make('nomor_dokumen'),
            Column::make('gudang_nama')->title('Nama Gudang'), // Kolom tambahan untuk gudang
            Column::make('tanggal_opname'),

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
        return 'stokOpname_' . date('YmdHis');
    }
}
