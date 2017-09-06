<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\NavigationRepository;

class NavigationController extends Controller
{
    /**
     * 导航列表
     *
     * @param NavigationRepository $navigationRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(NavigationRepository $navigationRepository)
    {
        $parents = $navigationRepository->getSelectNodes([1]);
        $navigation = $navigationRepository->getSelectNodes();

        $navigationBreak = [];
        $temp = [];
        foreach ($navigation as $v) {
            if ($v['parent_id'] === 0 && ! empty($temp)) {
                $navigationBreak[] = $temp;
                $temp = [];
            }
            $temp[] = $v;
        }
        $navigationBreak[] = $temp;

        return view('admin.navigation.index', ['parents' => $parents, 'allNodes' => $navigationBreak]);
    }

    /**
     * 添加导航的表单页面
     *
     * @param NavigationRepository $navigationRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(NavigationRepository $navigationRepository)
    {
        $navigation = $navigationRepository->getSelectNodes([1, 2]);

        return view('admin.navigation.create', ['navigation' => $navigation]);
    }

    /**
     * 添加导航的方法
     *
     * @param Request $request
     * @param NavigationRepository $navigationRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, NavigationRepository $navigationRepository)
    {
        $data = [];
        $data['title'] = strip_tags($request->input('title'));
        $data['parent_id'] = intval($request->input('parent_id'));
        $data['level'] = intval($request->input('level'));
        if ($data['level'] === 2 || $data['level'] === 3) {
            $data['icon'] = strip_tags($request->input('icon'));
            if ($data['level'] === 2) {
                $data['spread'] = $request->input('spread') === 'on' ? 1 : 0;
            }
        }
        $data['order'] = intval($request->input('order'));
        $data['href'] = strip_tags($request->input('href'));

        if ($navigationRepository->addNavigation($data) <= 0) {
            $this->result['code'] = 1;
        }

        return response()->json($this->result);
    }

    /**
     * 编辑导航的方法
     *
     * @param Request $request
     * @param NavigationRepository $navigationRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, NavigationRepository $navigationRepository)
    {
        $navigation = $navigationRepository->getNavigation(intval($request->navigation));

        return view('admin.navigation.edit', ['navigation' => $navigation]);
    }

    public function update(Request $request, NavigationRepository $navigationRepository)
    {
        $data = [];
        $data['title'] = strip_tags($request->input('title'));
        $data['level'] = intval($request->input('level'));
        if ($data['level'] === 2 || $data['level'] === 3) {
            $data['icon'] = strip_tags($request->input('icon'));
            if ($data['level'] === 2) {
                $data['spread'] = $request->input('spread') === 'on' ? 1 : 0;
            }
        }
        $data['order'] = intval($request->input('order'));
        $data['href'] = strip_tags($request->input('href'));
        $navigationId = intval($request->navigation);

        if ($navigationRepository->updateNavigation($navigationId, $data) <= 0) {
            $this->result['code'] = 1;
        }

        return response()->json($this->result);
    }

    public function destroy(Request $request, NavigationRepository $navigationRepository)
    {
        $navigationId = intval($request->navigation);
        $this->result['code'] = $navigationRepository->delete($navigationId);

        return response()->json($this->result);
    }

    public function getLeftNavigation(Request $request, NavigationRepository $navigationRepository)
    {
        $parentId = intval($request->parent_id);
        $navigation = $navigationRepository->getLeftNavigation($parentId);

        return response()->json($navigation);
    }
}
