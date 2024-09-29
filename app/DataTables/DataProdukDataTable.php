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
            // Tombol untuk mengedit data Gudang
            $editUrl = route('data_produk_edit', $row->id); // Sesuaikan dengan route edit produk
            $deleteUrl = route('data_produk_delete', $row->id);
            $iconGear = GEAR_SVG;
            $iconTrash = TRASH_SVG;
            return "<a href='{$editUrl}' class='btn btn-sm btn-warning rounded-circle'>".$iconGear."</a>
            <a href='{$deleteUrl}' class='btn btn-sm btn-danger rounded-circle my-2'>".$iconTrash."</a>";
        })
            
            ->setRowId('id')
            ->addColumn('nama', function ($row) {
                return $row->nama;
            })
            ->addColumn('kode', function ($row) {
                return $row->kode;
            })
            ->addColumn('kuantitas', function ($row) {
                return $row->kuanitas ?? 'N/A'; // Menambahkan data default jika tidak tersedia
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
        $iconPlus = PLUS_SVG;
        return $this->builder()
            ->setTableId('dataproduk-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                
                Button::make('reload'),
                Button::make('') // Tambahkan tombol custom 'Add'

                   
                ->text($iconPlus.' Add Produk')

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
            Column::make('kode'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->title('Aksi'),
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
