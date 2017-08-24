<?php

namespace App\Repositories;

use App\Model\Goods;

class GoodsRepository extends Repository
{
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