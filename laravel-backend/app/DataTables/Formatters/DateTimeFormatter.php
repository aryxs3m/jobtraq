<?php

namespace App\DataTables\Formatters;

use Carbon\Carbon;
use Yajra\DataTables\Contracts\Formatter;

class DateTimeFormatter implements Formatter
{
    public function format($value, $row): string
    {
        return (new Carbon($value))
            ->format('Y-m-d H:i:s');
    }
}
