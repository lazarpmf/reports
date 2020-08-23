<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $guarded = ['id'];

    public function users () {
        return $this->belongsToMany(User::class);
    }
}
