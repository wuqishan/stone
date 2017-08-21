<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    public function index()
    {
        return view('admin.goods.index');
    }

    public function create()
    {
        return view('admin.goods.create');
    }

    public function store()
    {

    }

    public function destroy()
    {

    }
}
