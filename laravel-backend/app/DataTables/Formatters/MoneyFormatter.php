<?php

namespace App\DataTables\Formatters;

use Carbon\Carbon;
use Yajra\DataTables\Contracts\Formatter;

class MoneyFormatter implements Formatter
{
    private string $currency;

    public function __construct(string $currency = 'Ft')
    {
        $this->currency = $currency;
    }

    public function format($value, $row): string
    {
        return number_format($value, 0, null, ' ').' '.$this->currency;
    }
}
