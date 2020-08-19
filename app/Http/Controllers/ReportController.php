<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index() {
        $reports = Report::all();

        return view('pages.reports', compact('reports'));
    }

    public function show(Report $report) {
        return view('pages.report-show', compact('report'));
    }
}
