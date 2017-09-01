<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\NavigationRepository;

class NavigationController extends Controller
{
    public function index()
    {
        return view('admin.navigation.index');
    }

    public function create(NavigationRepository $navigationRepository)
    {
        $navigation = $navigationRepository->getSelectParents();

        return view('admin.navigation.create', ['navigation' => $navigation]);
    }
}
