<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\NavigationRepository;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.auth.index');
    }

    public function create(NavigationRepository $navigationRepository)
    {
        $navigation = $navigationRepository->getSelectNodes([1, 2], 2);

        return view('admin.auth.create', ['navigation' => $navigation]);
    }

    public function store(Request $request, AuthRepository $authRepository)
    {
        $data = [];
        $data['title'] = strip_tags($request->input('title'));
        $data['auth'] = strip_tags($request->input('auth'));
        $data['navigation_id'] = intval($request->input('navigation_id'));

        if ($authRepository->addAuth($data) <= 0) {
            $this->result['code'] = 1;
        }

        return response()->json($this->result);
    }
}
