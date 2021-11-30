<?php

namespace App\Http\Controllers;

use App\Http\Resources\TypeResource;
use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{
    public function index(){
        $types = Type::get();

        return TypeResource::collection($types);
    }
}
