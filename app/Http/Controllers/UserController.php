<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $paginate = request('paginate',10);
        $search_term = request('q','');

        $users = User::with('type')->search(trim($search_term))->paginate($paginate);
        return UserResource::collection($users);
    }


    public function updateType(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->type_id = $request->input('type_id');
        $user->save();

        return ['message' => 'success'];
    }
}
