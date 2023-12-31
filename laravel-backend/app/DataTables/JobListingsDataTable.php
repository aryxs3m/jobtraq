<?php

namespace App\DataTables;

use App\DataTables\Formatters\DateTimeFormatter;
use App\DataTables\Formatters\MoneyFormatter;
use App\Models\JobListing;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Exceptions\Exception;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class JobListingsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query results from query() method
     *
     * @throws Exception
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'job-listings.action')
            ->addColumn('location', function (JobListing $jobListing) {
                return $jobListing->location ? $jobListing->location->location : '';
            })
            ->formatColumn('created_at', new DateTimeFormatter())
            ->formatColumn('salary_avg', new MoneyFormatter())
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(JobListing $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('joblistings-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->pageLength(20)
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::formatted('created_at'),
            Column::make('name'),
            Column::make('original_location'),
            Column::make('location'),
            Column::make('position'),
            Column::make('level'),
            Column::make('stack'),
            Column::formatted('salary_avg'),
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
        return 'JobListings_'.date('YmdHis');
    }
}
