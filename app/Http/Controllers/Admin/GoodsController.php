<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\GoodsRepository;
use App\Repositories\ImageRepository;
use App\Repositories\GoodsImageRepository;

class GoodsController extends Controller
{
    /**
     * 显示商品列表
     *
     * @param Request $request
     * @param GoodsRepository $goodsRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request, GoodsRepository $goodsRepository)
    {
        if ($request->ajax()) {

            $data['pageIndex'] = $request->input('pageIndex', 1);
            $data['pageSize'] = $request->input('pageSize', 10);
            $data['goodsName'] = $request->input('goodsName');
            $data['priceMin'] = sprintf("%.2f", (float) $request->input('priceMin'));
            $data['priceMax'] = sprintf("%.2f", (float) $request->input('priceMax'));
            $this->result = $goodsRepository->page($data) + $this->result;

            return response()->json($this->result);
        }

        return view('admin.goods.index');
    }

    /**
     * 显示创建商品的界面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.goods.create');
    }

    /**
     * 获取商品信息，显示商品更新页面
     *
     * @param Request $request
     * @param GoodsRepository $goodsRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, GoodsRepository $goodsRepository)
    {
        $goods = $goodsRepository->getByPk(intval($request->goods_id));

        return view('admin.goods.edit', ['goods' => $goods]);
    }

    /**
     * 添加商品
     *
     * @param Request $request
     * @param GoodsRepository $goodsRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, GoodsRepository $goodsRepository)
    {
        $data = [];
        $data['name'] = strip_tags($request->input('name'));
        $data['show'] = $request->input('show') === 'on' ? 1 : 0;
        $data['length'] = intval($request->input('length'));
        $data['width'] = intval($request->input('width'));
        $data['height'] = intval($request->input('height'));
        $data['weight'] = sprintf("%.2f", (float) $request->input('weight'));
        $data['price'] = sprintf("%.2f", (float) $request->input('price'));
        $data['introduce'] = strip_tags($request->input('introduce'));

        if ($goodsRepository->addGoods($data) <= 0) {
            $this->result['code'] = 1;
        }

        return response()->json($this->result);
    }

    public function update(Request $request, GoodsRepository $goodsRepository)
    {
        $data = [];
        $goodsId = intval($request->input('goods_id'));
        $data['name'] = strip_tags($request->input('name'));
        $data['show'] = $request->input('show') === 'on' ? 1 : 0;
        $data['length'] = intval($request->input('length'));
        $data['width'] = intval($request->input('width'));
        $data['height'] = intval($request->input('height'));
        $data['weight'] = sprintf("%.2f", (float) $request->input('weight'));
        $data['price'] = sprintf("%.2f", (float) $request->input('price'));
        $data['introduce'] = strip_tags($request->input('introduce'));

        if ($goodsRepository->updateGoods($goodsId, $data) <= 0) {
            $this->result['code'] = 1;
        }

        return response()->json($this->result);
    }

    public function updateShow(Request $request, GoodsRepository $goodsRepository)
    {
        $goodsId = intval($request->goods_id);
        $data['show'] = intval($request->if_show);
        if ($goodsRepository->updateGoods($goodsId, $data) <= 0) {
            $this->result['code'] = 1;
        }

        return response()->json($this->result);
    }

    public function delete(
        Request $requests,
        GoodsRepository $goodsRepository,
        GoodsImageRepository $goodsImageRepository,
        ImageRepository $imageRepository
    )
    {
        $goodsIds = array_filter(explode(',', $requests->goods_ids));
        $imagesIds = $goodsImageRepository->getImagesId($goodsIds);

        $imageRepository->delete($imagesIds);
        $goodsImageRepository->deleteByGoodsIds($goodsIds);
        if (! $goodsRepository->destroy($goodsIds)) {
            $this->result['code'] = 1;
        }

        return response()->json($this->result);
    }
}
