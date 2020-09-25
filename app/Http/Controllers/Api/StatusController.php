<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStatus;
use App\Http\Requests\DeleteStatus;
use App\Http\Resources\StatusResource;
use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::latest()->paginate(2);

        return StatusResource::collection($statuses);
    }

    public function store(CreateStatus $request)
    {
        $status = Status::create([
            'description' => $request->description,
            'user_id' => auth()->user()->id,
        ]);

        return new StatusResource($status);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(DeleteStatus $request, Status $status)
    {
        $status->delete();

        return new StatusResource($status);
    }
}
