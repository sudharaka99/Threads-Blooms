<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function sales()
    {
        return view('admin.reports.sales');
    }

    public function products()
    {
        return view('admin.reports.products');
    }

    public function customers()
    {
        return view('admin.reports.customers');
    }

    public function export()
    {
        return redirect()->back();
    }
}
