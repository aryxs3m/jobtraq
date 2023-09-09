<?php

namespace App\DataTables\Formatters;

use Yajra\DataTables\Contracts\Formatter;

class BooleanFormatter implements Formatter
{
    public function format($value, $row): string
    {
        return 1 === $value ? '✓' : '✗';
    }
}
