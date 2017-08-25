<?php

namespace App\Repositories;

use App\Model\GoodsImages;

class GoodsImageRepository extends Repository
{
    /**
     * 添加商品与商品图片的关联关系
     *
     * @param $goodsId
     * @param $imgIds
     * @return bool
     */
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

    public function delete($goodsId, $imageId)
    {
        return GoodsImages::where(['goods_id' => $goodsId, 'images_id' => $imageId])->delete();
    }

    public function getImagesId($goodsId)
    {
        $images = GoodsImages::where(['goods_id' => $goodsId])->get(['images_id'])->toArray();

        return array_column($images, 'images_id');
    }
}