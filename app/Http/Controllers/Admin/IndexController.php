<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\NavigationRepository;

class IndexController extends Controller
{
    public function index(Request $request, NavigationRepository $navigationRepository)
    {
        $navigation = $navigationRepository->getSelectNodes([1]);

        return view('admin.index.index', ['navigation' => $navigation]);
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
