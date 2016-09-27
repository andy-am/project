<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class RoleController extends Controller
{

    public function store(){

        request()->user()->makeEmployee("super_admin");
        dd(request()->user()->roles);
    }
}
