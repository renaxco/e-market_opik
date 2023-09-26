<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimulasiCucianController extends Controller
{
    public function index(){
        return view('simulasi_cucian.index');
    }
}
