<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WallController extends Controller
{
    public function read($search = false)
    {
        return view('read', ['search' => $search]);
    }
}
