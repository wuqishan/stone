<?php

namespace App\Repositories;

use App\Model\GoodsImages;

class GoodsImageRepository extends Repository
{
    public function addGoodsImagesRelative($goodsId, $imgIds)
    {
        $result = true;
        $imgIds = array_filter(explode(',', $imgIds));
        foreach ($imgIds as $v) {
            if (! GoodsImages::create(['goods_id' => $goodsId, 'images_id' => $v])) {
                GoodsImages::where('goods_id', '=', $goodsId)->delete();
                $result = false;
            }
        }

        return $result;
    }
}