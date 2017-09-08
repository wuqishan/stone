<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\AuthGroupRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthGroupController extends Controller
{
    public function index(Request $request, AuthGroupRepository $authGroupRepository)
    {
        if ($request->ajax()) {
            $data['pageIndex'] = $request->input('pageIndex', 1);
            $data['pageSize'] = $request->input('pageSize', 10);
            $data['title'] = $request->input('title');
            $data['auth'] = $request->input('auth');
            $data['navigation_id'] = intval($request->input('navigationId'));
            $this->result = $authGroupRepository->page($data) + $this->result;

            return response()->json($this->result);
        }

        return view('admin.auth_group.index');
    }

    public function create()
    {
        return view('admin.auth_group.create');
    }
}
