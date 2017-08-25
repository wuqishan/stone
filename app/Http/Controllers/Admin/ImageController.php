<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ImageRepository;
use App\Repositories\GoodsImageRepository;

class ImageController extends Controller
{
    const FILE_IMG_DIR = 'storage/uploads/images/';

    /**
     * 图片上传
     *
     * @param Request $request
     * @param ImageRepository $imageRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request, ImageRepository $imageRepository)
    {
        $goodsId = intval($request->input('goods_id'));
        if($request->hasFile('images')){
            $data = [];
            foreach ($request->file('images') as $img) {
                $temp['origin_name'] = $img->getClientOriginalName();
                $temp['ext'] = $img->getClientOriginalExtension();
                $mimeTye = $img->getMimeType();
                $removeName = $this->getUniqueName() . '.' . $temp['ext'];
                $img->move(self::FILE_IMG_DIR, $removeName);
                $temp['size'] = $img->getSize();
                $temp['path'] = self::FILE_IMG_DIR . $removeName;

                $data[] = $temp;
            }
            $this->result['data'] = $imageRepository->addImage($data, $goodsId);
        }

        return response()->json($this->result);
    }

    /**
     * ajax删除图片
     *
     * @param Request $request
     * @param ImageRepository $imageRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, ImageRepository $imageRepository, GoodsImageRepository $goodsImageRepository)
    {
        $goodsId = intval($request->goods_id);
        $imageId = intval($request->image_id);
        if ($goodsId <= 0 || ! $imageRepository->delete($imageId) || ! $goodsImageRepository->delete($goodsId, $imageId)) {
            $this->result['code'] = 1;
        }

        return response()->json($this->result);
    }

    public function getImagesByGoogsId(Request $request, ImageRepository $imageRepository, GoodsImageRepository $goodsImageRepository)
    {
        $goodsId = intval($request->goods_id);
        $imageId = $goodsImageRepository->getImagesId($goodsId);
        $this->result['data'] = $imageRepository->getImages($imageId);

        if ($goodsId <= 0 || ! $this->result['data']) {
            $this->result['code'] = 1;
        }

        return response()->json($this->result);
    }
}
