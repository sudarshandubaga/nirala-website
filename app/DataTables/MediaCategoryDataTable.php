<?php

namespace App\DataTables;

use App\Models\MediaCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
// use Yajra\DataTables\Html\Editor\Editor;
// use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MediaCategoryDataTable extends DataTable
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
            ->addColumn('action', function ($mediaCategory) {
                return '
                <a href="' . route('admin.media-category.edit', $mediaCategory) . '" class="btn btn-link"><i class="bx bx-pencil"></i></a>
                <button type="button" class="btn btn-link text-danger btn-delete" data-href="' . route('admin.media-category.destroy', $mediaCategory) . '"><i class="bx bx-trash"></i></a>
            ';
            })
            ->addColumn('image', function ($mediaCategory) {
                return $mediaCategory->image ?
                    '<img src="' . $mediaCategory->image . '" class="table-img" loading="lazy" />'
                    : 'Not Uploaded';
            })
            ->rawColumns(['action', 'image'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MediaCategory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MediaCategory $model): QueryBuilder
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
            ->setTableId('media-category-table')
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
            Column::make('name'),
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
        return 'MediaCategory_' . date('YmdHis');
    }
}
