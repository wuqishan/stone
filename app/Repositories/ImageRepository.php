<?php

namespace App\Repositories;

use App\Model\Images;
use App\Model\GoodsImages;

class ImageRepository extends Repository
{
    /**
     * 添加图片
     *
     * @param $data
     * @return array
     */
    public function addImage($data, $goodsId)
    {
        $result = [];
        foreach ($data as $v) {
            $v['img_id'] = Images::create($v)->id;
            $result[] = $v;

            GoodsImages::create(['goods_id' => $goodsId, 'images_id' => $v['img_id']]);
        }

        return $result;
    }

    /**
     * 通过当前图片的id删除图片
     *
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return Images::destroy($id);
    }


    public function getImagesByGoogsId($goodsId)
    {
        return Images::where(['id' => $goodsId])->get();
    }
}