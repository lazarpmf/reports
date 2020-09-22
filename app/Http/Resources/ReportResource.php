<?php

namespace App\Http\Resources;

use App\Report;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{

    public function toArray($request)
    {
        $user = User::find($this->user_id); 
        $report = Report::find($this->id);
        $assignedWorkers = User::find($request->workers);
        $isAuthor = auth()->user()->id === $user->id;
        // $workers = $report->users;

        return [
            'id' => $this->id,
            'author' => $user->name,
            // 'workers' => $workers,
            'ids' => $request->workers,
            'isAuthor' => $isAuthor,
            // 'workers' => $assignedWorkers,
            'description' => $this->description,
            'project' => $this->project,
            'created' => Carbon::parse($this->created_at)->isoFormat('D-M-Y'),
        ];
    }
}
