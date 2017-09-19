<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\GroupRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function index(Request $request, GroupRepository $groupRepository)
    {
        if ($request->ajax()) {
            $data['pageIndex'] = $request->input('pageIndex', 1);
            $data['pageSize'] = $request->input('pageSize', 10);
            $data['title'] = $request->input('title');
            $data['comments'] = $request->input('comments');
            $this->result = $groupRepository->page($data) + $this->result;

            return response()->json($this->result);
        }

        return view('admin.group.index');
    }

    public function create()
    {
        return view('admin.group.create');
    }

    public function store(Request $request, GroupRepository $groupRepository)
    {
        $data = [];
        $data['title'] = strip_tags($request->input('title'));
        $data['comments'] = strip_tags($request->input('comments'));

        if ($groupRepository->addGroup($data) <= 0) {
            $this->result['code'] = 1;
        }

        return response()->json($this->result);
    }
}
