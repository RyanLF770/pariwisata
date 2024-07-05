<?php

namespace App\Http\Controllers;
use App\Models\Destination;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $destinations = Destination::all();
        return view('user.index', compact('destinations'));
    }
}
