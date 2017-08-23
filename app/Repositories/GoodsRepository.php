<?php

namespace App\Repositories;

use App\Model\Goods;

class GoodsRepository extends Repository
{
    public function addGoods($data)
    {
        return Goods::create($data)->id;
    }

    public function destroy($goodsId)
    {
        return Goods::destroy($goodsId);
    }
}