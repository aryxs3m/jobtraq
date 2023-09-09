<?php

namespace App\DataTables\Formatters;

use Yajra\DataTables\Contracts\Formatter;

class ClassBasenameFormatter implements Formatter
{
    public function format($value, $row): string
    {
        return class_basename($value);
    }
}
