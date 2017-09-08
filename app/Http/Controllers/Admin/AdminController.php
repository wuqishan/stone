<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(Request $request, AdminRepository $adminRepository)
    {
        if ($request->ajax()) {
            $data['pageIndex'] = $request->input('pageIndex', 1);
            $data['pageSize'] = $request->input('pageSize', 10);
            $data['title'] = $request->input('title');
            $data['auth'] = $request->input('auth');
            $data['navigation_id'] = intval($request->input('navigationId'));
            $this->result = $adminRepository->page($data) + $this->result;

            return response()->json($this->result);
        }

        return view('admin.admin.index');
    }

    public function create()
    {
        return view('admin.admin.create');
    }
}
