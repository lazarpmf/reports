<?php

namespace App\Http\Resources;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
{
    public function toArray($request)
    {
        $user = User::find($this->user_id);
        $isAuthor = auth()->user()->id === $user->id;

        Carbon::setLocale('sr');
        return [
            'id' => $this->id,
            'description' => $this->description,
            // 'isAuthor' => $isAuthor,
            'authorName' => $user->name,
            'created' => $this->created_at->diffForHumans(),
        ];
    }
}
