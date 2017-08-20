<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{

    public function index()
    {
        return view('admin.image.image');
    }

    public function create()
    {
        return view('admin.image.create');
    }

    public function store()
    {

    }

    public function destroy()
    {

    }
}
