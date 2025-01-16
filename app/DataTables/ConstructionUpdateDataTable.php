<?php

namespace App\DataTables;

use App\Models\ConstructionUpdate;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ConstructionUpdateDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($constructionUpdate) {
                return '
                <a href="' . route('admin.construction-update.edit', $constructionUpdate) . '" class="btn btn-link"><i class="bx bx-pencil"></i></a>
                <button type="button" class="btn btn-link text-danger btn-delete" data-href="' . route('admin.construction-update.destroy', $constructionUpdate) . '"><i class="bx bx-trash"></i></a>
            ';
            })
            ->addColumn('project_image', function ($constructionUpdate) {
                return !empty($constructionUpdate->project->image) ?
                    '<img src="' . asset("storage/" . $constructionUpdate->project->image) . '" class="table-img" loading="lazy" />'
                    : 'Not Uploaded';
            })
            ->addColumn('project_name', function ($constructionUpdate) {
                return $constructionUpdate->tower->phase->project->name . " / " . $constructionUpdate->tower->phase->name . " / " . $constructionUpdate->tower->name;
            })
            ->rawColumns(['action', 'description', 'project_image'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ConstructionUpdate $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ConstructionUpdate $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('constructionUpdate-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                // Button::make('pdf'),
                Button::make('print'),
                // Button::make('reset'),
                // Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('Sr. No.')
                ->searchable(false)
                ->orderable(false),
            Column::make('title'),
            Column::make('project_image'),
            Column::make('project_name'),
            Column::make('description'),
            Column::make('action'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'ConstructionUpdate_' . date('YmdHis');
    }
}
