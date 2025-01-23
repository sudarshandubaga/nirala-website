<?php

namespace App\DataTables;

use App\Models\Applicant;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ApplicantDataTable extends DataTable
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
            ->addColumn('action', function ($careerPost) {
                return '
            <button type="button" class="btn btn-link text-danger btn-delete" data-href="' . route('admin.career-enquiry.destroy', $careerPost) . '"><i class="bx bx-trash"></i></a>
        ';
            })
            ->addColumn('file', function ($careerPost) {
                return '
                        <div class="mb-1">
                            <a href="' .
                    // asset('storage/' . $careerPost->application_form)
                    route('admin.applicant.show', $careerPost)
                    . '" class="btn btn-sm btn-primary" target="_blank">
                                <i class="bx bx-download"></i> Form
                            </a>
                        </div>
                        <a href="' .  asset('storage/' . $careerPost->resume_file) . '" class="btn btn-sm btn-primary" target="_blank">
                            <i class="bx bx-download"></i> Resume
                        </a>
                    ';
            })
            ->addColumn('photo', function ($careerPost) {
                if ($careerPost->image) {
                    $filePath = asset('storage/' . $careerPost->image); // Generate full URL for the file
                    return '<a href="' . $filePath . '" target="_blank" class="border rounded">
                        <img src=' . $filePath . ' style="height: 50px" />
                    </a>';
                }
                return 'No File';
            })
            ->addColumn('contact', function ($careerPost) {
                return '<div class="mb-1" style="white-space: nowrap">
                        <a href="mailto:' . $careerPost->email . '">
                            <i class="bx bx-envelope"></i> ' . $careerPost->email . '
                        </a>
                    </div>
                    <div class="mb-1">
                        <a href="tel:' . $careerPost->phone_number . '">
                            <i class="bx bx-phone"></i> ' . $careerPost->phone_number . '
                        </a>
                    </div>
                    <div>
                            <i class="bx bx-map"></i> ' . $careerPost->current_address . '
                    </div>';
                return 'No File';
            })
            ->addColumn('post', function ($careerPost) {
                return $careerPost?->career_post?->title ?? 'N/A';
            })
            ->addColumn('date', function ($careerPost) {
                return date('d/m/Y', strtotime($careerPost->created_at));
            })
            ->rawColumns(['action', 'file',  'photo', 'contact'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Applicant $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Applicant $model): QueryBuilder
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
            ->setTableId('careerPost-table')
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
            Column::make('full_name')->title('Name'),
            Column::make('post'),
            Column::make('photo')
                ->searchable(false)
                ->orderable(false),
            // Column::make('father_or_husband_name')->title('Father/Husband'),
            Column::make('contact'),
            // Column::make('phone_number'),
            // Column::make('current_address'),
            // Column::make('experience'),
            Column::make('current_ctc'),
            Column::make('expected_ctc'),
            Column::make('notice_period'),
            Column::make('file'),
            Column::make('date'),
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
        return 'Applicant_' . date('YmdHis');
    }
}
