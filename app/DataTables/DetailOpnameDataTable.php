<?php

namespace App\DataTables;

use App\Models\DetailStokOpname;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

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
                $settingsUrl = route('product.settings', $row->id);
                
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
        // Mengambil data detail opname terkait berdasarkan id_stok_opname
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
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('id_produk')->title('ID Produk'),
            Column::make('kuantitas')->title('Kuantitas'),
            Column::make('fisik_all')->title('Fisik Semua'),
            Column::make('selisih')->title('Selisih'),
            Column::make('keterangan')->title('Keterangan'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'detailOpname_' . date('YmdHis');
    }
}

?>