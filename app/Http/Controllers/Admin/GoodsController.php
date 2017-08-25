<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\GoodsRepository;
use App\Repositories\ImageRepository;
use App\Repositories\GoodsImageRepository;

class GoodsController extends Controller
{
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

    public function create()
    {
        return view('admin.goods.create');
    }

    /**
     * 添加商品，首先是异步上传零时商品图片，等商品正确添加后再把零时图片转移到正式目录同时修改数据库
     *
     * @param Request $request
     * @param GoodsRepository $goodsRepository
     * @param ImageRepository $imageRepository
     * @param GoodsImageRepository $goodsImageRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(
        Request $request,
        GoodsRepository $goodsRepository,
        ImageRepository $imageRepository,
        GoodsImageRepository $goodsImageRepository
    )
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
        $imgIds = $request->input('image_id');

        $goodsId = $goodsRepository->addGoods($data);
        if ($goodsId > 0) {
            if (! $goodsImageRepository->addGoodsImagesRelative($goodsId, $imgIds)) {
                $goodsRepository->destroy($goodsId);
                $this->result['code'] = 1;
            } else {
                // 更新图片位置及数据库
                $imageRepository->modifyFromTemp($imgIds);
            }
        } else {
            $this->result['code'] = 1;
        }

        return response()->json($this->result);
    }

}
