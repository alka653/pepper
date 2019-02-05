<?php

namespace App\Exports;

use App\Mascotas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MascotasExport implements FromView{
    private $query;
    const DIR_TEMPLATE = 'reportes.';
    public function __construct($query){
        $this->query = $query;
    }
    public function view(): View{
        return view(self::DIR_TEMPLATE.'excel.mascota', [
            'mascotas' => $this->query
        ]);
    }
}