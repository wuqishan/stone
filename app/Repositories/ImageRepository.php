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
            $v['id'] = Images::create($v)->id;
            $result[] = $v;

            GoodsImages::create(['goods_id' => $goodsId, 'images_id' => $v['id']]);
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
        if (is_array($id)) {
            foreach ($id as $v) {
                @unlink(base_path() . '/public/' . Images::find($v)->path);
            }
        } else {
            @unlink(base_path() . '/public/' . Images::find($id)->path);
        }

        return Images::destroy($id);
    }


    public function getImages($imagesId)
    {
        return Images::whereIn('id', $imagesId)->get()->toArray();
    }
}