<?php

namespace App\DataTables\Formatters;

use Carbon\Carbon;
use Yajra\DataTables\Contracts\Formatter;

class BooleanFormatter implements Formatter
{
    public function format($value, $row): string
    {
        return $value === 1 ? '✓' : '✗';
    }
}
