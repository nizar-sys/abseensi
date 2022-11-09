<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RombelController extends Controller
{
    public function index()
    {
        return view('admin.master_data.rombels.index');
    }
}
