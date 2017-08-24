<?php

namespace App\Repositories;

use App\Model\Images;

class ImageRepository extends Repository
{
    /**
     * 添加图片
     *
     * @param $data
     * @return array
     */
    public function addImage($data)
    {
        $result = [];
        foreach ($data as $v) {
            $v['img_id'] = Images::create($v)->id;
            $result[] = $v;
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

    /**
     * 商品添加成功后修改商品图片路径地址
     *
     * @param $imgIds
     * @return bool
     */
    public function modifyFromTemp($imgIds)
    {
        $imgIds = array_filter(explode(',', $imgIds));
        $images = Images::whereIn('id', $imgIds)->get();

        foreach ($images as $img) {
            $img->path = $this->copyImg($img->path);
            $img->save();
        }

        return true;
    }

    /**
     * 把temp文件夹中的零时文件转移到images里面
     *
     * @param $imagePath
     * @return mixed
     */
    public function copyImg($imagePath)
    {
        $oldPath = base_path('public/' . $imagePath);
        $newPath = dirname(dirname($oldPath)). '/images/' . basename($imagePath);

        if (file_exists($oldPath) && copy($oldPath, $newPath)) {
            unlink($oldPath);
        }

        return str_replace(base_path('public'), '', $newPath);
    }
}