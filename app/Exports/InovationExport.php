<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InovationExport implements FromView
{
    protected $results;

    public function __construct($results)
    {
        $this->results = $results;
    }

    public function view(): View
    {
        return view('exports.innovations', [
            'inovations' => $this->results
        ]);
    }
}