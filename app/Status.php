<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $guarded = ['id'];

    public function user () {
        $this->belongsTo(User::class);
    }
}
