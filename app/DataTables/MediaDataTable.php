<?php

namespace App\DataTables;

use App\Models\Media;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MediaDataTable extends DataTable
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
            ->addColumn('action', function ($media) {
                return '
                <a href="' . route('admin.media.edit', $media) . '" class="btn btn-link"><i class="bx bx-pencil"></i></a>
                <button type="button" class="btn btn-link text-danger btn-delete" data-href="' . route('admin.media.destroy', $media) . '"><i class="bx bx-trash"></i></a>
            ';
            })
            ->addColumn('image', function ($media) {
                return $media->image ?
                    '<img src="' .  $media->image . '" class="table-img" loading="lazy" />'
                    : 'Not Uploaded';
            })
            ->addColumn('media_category_name', function ($media) {
                return !empty($media->mediaCategory->name) ? $media->mediaCategory->name : '-';
            })
            ->rawColumns(['action', 'image'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Media $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Media $model): QueryBuilder
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
            ->setTableId('media-table')
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
            Column::make('image'),
            Column::make('media_category_name'),
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
        return 'Media_' . date('YmdHis');
    }
}
