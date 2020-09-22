<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function upload(Request $request) {
        $path = $request->file('image')->store('images', 'public');
        $user = User::find(auth()->user()->id);
        $user->update([
            'image' => 'storage/images/'.$path,
        ]);

        return view('/home', compact('path'));
    }
}
