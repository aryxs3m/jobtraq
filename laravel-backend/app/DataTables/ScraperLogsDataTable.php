<?php

namespace App\DataTables;

use App\DataTables\Formatters\ClassBasenameFormatter;
use App\DataTables\Formatters\DateTimeFormatter;
use App\Models\ScraperLog;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Exceptions\Exception;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ScraperLogsDataTable extends DataTable
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
            ->addColumn('action', 'scraper-logs.action')
            ->editColumn('log', function (ScraperLog $log) {
                return $log->log['message'];
            })
            ->formatColumn('created_at', new DateTimeFormatter())
            ->formatColumn('scraper', new ClassBasenameFormatter())
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ScraperLog $model): QueryBuilder
    {
        return $model->newQuery()
            ->orderBy('id', 'DESC');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('scraperlogs-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
                    // ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::formatted('created_at'),
            Column::formatted('scraper'),
            Column::make('log'),
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
        return 'ScraperLogs_'.date('YmdHis');
    }
}
