<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $paginate = request('paginate',10);

        $users = User::with('type')->paginate($paginate);
        return UserResource::collection($users);
    }
}
