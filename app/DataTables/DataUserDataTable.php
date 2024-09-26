<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DataUserDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                $editUrl = route('data_user_edit', $row->id);
                $deleteUrl = route('data_user_delete', $row->id);
                return "<a href='{$editUrl}' class='btn btn-sm btn-warning rounded-circle'><i class='bi bi-gear'></i></a>
                <a href='{$deleteUrl}' class='btn btn-sm btn-danger rounded-circle my-2' onclick='event.preventDefault(); document.getElementById(\"delete-form-{$row->id}\").submit();'><i class='bi bi-trash'></i></a>
                <form id='delete-form-{$row->id}' action='{$deleteUrl}' method='POST' style='display: none;'>".csrf_field().method_field('DELETE')."</form>";
            })
            ->setRowId('id')
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('email', function ($row) {
                return $row->email;
            });
    }

    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('reset'),
                Button::make('reload'),
                Button::make('add')
                    ->text('<i class="bi bi-plus"></i> Add User')
                    ->action('function(){ window.location.href = "' . route('data_user_add') . '"; }')
                    ->addClass('btn btn-success'),
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('name')->title('Name'),
            Column::make('email')->title('Email'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->title('Actions'),
        ];
    }

    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}

