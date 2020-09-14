<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWorker;
use App\Http\Requests\DeleteWorker;
use App\Http\Resources\UserResource;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::all();

        return UserResource::collection($users);
    }

    public function store (CreateWorker $request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return new UserResource($user);
    }

    public function destroy (DeleteWorker $request, User $user) {
        $user->delete();

        return new UserResource($user);
    }
}
