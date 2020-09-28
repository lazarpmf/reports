<?php

namespace App\Http\Resources;

use App\Comment;
use App\Status;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
{
    public function toArray($request)
    {
        $user = User::find($this->user_id);
        $isAuthor = auth()->user()->id === $user->id;

        // $status = Status::find($this->id);
        // $comments = $status->comments;
        

        Carbon::setLocale('sr');
        return [
            'id' => $this->id,
            'description' => $this->description,
            // 'isAuthor' => $isAuthor,
            // 'comments' => $comments,
            // 'commentsNumber' => $comments->count(),
            'authorName' => $user->name,
            'created' => $this->created_at->diffForHumans(),
        ];
    }
}
