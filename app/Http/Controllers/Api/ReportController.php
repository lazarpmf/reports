<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteReport;
use App\Http\Requests\ShowReport;
use App\Http\Resources\ReportResource;
use App\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function index()
    {
        $reports = Report::all();

        return ReportResource::collection($reports);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(ShowReport $request, Report $report)
    {
        return new ReportResource($report);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(DeleteReport $request, Report $report)
    {
        $report->delete();
        return new ReportResource($report);
    }
}
