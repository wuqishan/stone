<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\GoodsRepository;
use App\Repositories\GoodsImageRepository;

class GoodsController extends Controller
{
    public function index()
    {
        return view('admin.goods.index');
    }

    public function create()
    {
        return view('admin.goods.create');
    }

    public function store(Request $request, GoodsRepository $goodsRepository, GoodsImageRepository $goodsImageRepository)
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
            }
        } else {
            $this->result['code'] = 1;
        }

        return response()->json($this->result);
    }

    public function destroy()
    {

    }
}
