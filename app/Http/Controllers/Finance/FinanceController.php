<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function kas()
    {
        return view('finance.kas-masuk-keluar');
    }

    public function laporan()
    {
        return view('finance.laporan-keuangan');
    }

    public function rekonsiliasi()
    {
        return view('finance.rekonsiliasi');
    }
}
