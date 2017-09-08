<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\NavigationRepository;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function index(Request $request, AuthRepository $authRepository, NavigationRepository $navigationRepository)
    {
        if ($request->ajax()) {
            $data['pageIndex'] = $request->input('pageIndex', 1);
            $data['pageSize'] = $request->input('pageSize', 10);
            $data['title'] = $request->input('title');
            $data['auth'] = $request->input('auth');
            $data['navigation_id'] = intval($request->input('navigationId'));
            $this->result = $authRepository->page($data) + $this->result;

            foreach ($this->result['list'] as $k => $v) {
                $temp = $navigationRepository->getNavigation($v['navigation_id']);
                $this->result['list'][$k]['navigation_title'] = $temp['title'];
            }

            return response()->json($this->result);
        }

        $navigation = $navigationRepository->getSelectNodes([1, 2], 2);

        return view('admin.auth.index', ['navigation' => $navigation]);
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

    public function destroy(Request $request, AuthRepository $authRepository)
    {
        $authId = explode(',', trim($request->auth));
        if (! $authRepository->delete($authId)) {
            $this->result['code'] = 1;
        }

        return response()->json($this->result);
    }

    public function edit(Request $request, AuthRepository $authRepository, NavigationRepository $navigationRepository)
    {
        $authId = intval($request->auth);
        $auth = $authRepository->getAuth($authId);
        $navigation = $navigationRepository->getSelectNodes([1, 2], 2);

        return view('admin.auth.edit', ['auth' => $auth, 'navigation' => $navigation]);
    }

    public function update(Request $request, AuthRepository $authRepository)
    {
        $data = [];
        $data['title'] = strip_tags($request->input('title'));
        $data['auth'] = strip_tags($request->input('auth_temp'));
        $data['navigation_id'] = intval($request->input('navigation_id'));
        $authId = intval($request->auth);

        if ($authRepository->updateAuth($authId, $data) <= 0) {
            $this->result['code'] = 1;
        }

        return response()->json($this->result);
    }
}
