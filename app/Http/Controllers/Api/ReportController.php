<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateReport;
use App\Http\Requests\DeleteReport;
use App\Http\Requests\ShowReport;
use App\Http\Resources\ReportResource;
use App\Notifications\NewReportNotification;
use App\Report;
use App\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function index()
    {
        $reports = Report::latest()->get();

        return ReportResource::collection($reports);
    }

    public function store(CreateReport $request)
    {
        $report = Report::create([
            'user_id' => auth()->user()->id,
            'project' => $request->project,
            'description' => $request->description,
        ]);

        // sending notification
        $admin = User::find(1);
        $admin->notify(new NewReportNotification);

        $users = $request->workers;
        $report->users()->attach($users);
        return new ReportResource($report);
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
