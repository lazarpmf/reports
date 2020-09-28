<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id'];

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }
}
