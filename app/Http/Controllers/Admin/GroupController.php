<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\AuthRepository;
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

    public function edit(Request $request, GroupRepository $groupRepository)
    {
        $groupId = intval($request->group);
        $group = $groupRepository->getGroup($groupId);

        return view('admin.group.edit', ['group' => $group]);
    }

    public function update(Request $request, GroupRepository $groupRepository)
    {
        $data = [];
        $data['title'] = strip_tags($request->input('title'));
        $data['comments'] = strip_tags($request->input('comments'));
        $groupId = intval($request->group);

        if ($groupRepository->updateGroup($groupId, $data) <= 0) {
            $this->result['code'] = 1;
        }

        return response()->json($this->result);
    }

    public function destroy(Request $request, GroupRepository $groupRepository)
    {
        $groupId = explode(',', trim($request->group));
        if (! $groupRepository->delete($groupId)) {
            $this->result['code'] = 1;
        }

        return response()->json($this->result);
    }

    public function editGroupAuth(Request $request, GroupRepository $groupRepository, AuthRepository $authRepository)
    {
        $groupId = $request->group_id;
        $authRepository->getAllAuth();


        return view('admin.group.edit_group_auth', ['group' => 111]);
    }

    public function updateGroupAuth(Request $request, GroupRepository $groupRepository)
    {

    }
}
