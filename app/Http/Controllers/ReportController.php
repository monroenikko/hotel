<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reportsCollection()
    {
        return view('admin.reports.index');
    }

    public function remittedCollection()
    {
        return view('admin.reports.remitt');
    }
}
