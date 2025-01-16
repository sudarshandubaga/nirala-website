<?php

namespace App\DataTables;

use App\Models\CareerEnquiry;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CareerEnquiryDataTable extends DataTable
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
             ->addColumn('resume', function ($careerPost) {
                if ($careerPost->resume) {
                    $filePath = asset('storage/'.$careerPost->resume); // Generate full URL for the file
                    return '<a href="' . $filePath . '" class="btn btn-sm btn-primary" download>Download</a>';
                }
                return 'No File';
            })
            ->rawColumns(['action','resume', 'description', 'project_image'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CareerEnquiry $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CareerEnquiry $model): QueryBuilder
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
            Column::make('name'),
            Column::make('gender'),
            Column::make('email'),
            Column::make('phone'),
            Column::make('address'),
            Column::make('experience'),
            Column::make('current_salary'),
            Column::make('expected_salary'),
            Column::make('resume'),
            Column::make('previous_company_name'),
            Column::make('remarks'),
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
        return 'CareerEnquiry_' . date('YmdHis');
    }
}
