<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.index.index');
    }

    public function main()
    {
        return view('admin.index.main');
    }

    public function admin()
    {
        return view('admin.index.admin');
    }
}
