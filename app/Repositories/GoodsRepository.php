<?php

namespace App\Repositories;

use App\Model\Goods;

class GoodsRepository extends Repository
{
    public function page($pageIndex, $pageSize)
    {
        $result['list'] = Goods::where([])->offset(($pageIndex - 1) * $pageSize)->limit($pageSize)->get()->toArray();
        $result['count'] = Goods::where([])->count();

        return $result;
    }

    /**
     * 添加商品
     *
     * @param $data
     * @return mixed
     */
    public function addGoods($data)
    {
        return Goods::create($data)->id;
    }

    /**
     * 删除商品
     *
     * @param $goodsId
     * @return int
     */
    public function destroy($goodsId)
    {
        return Goods::destroy($goodsId);
    }
}