<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ImageRepository;

class ImageController extends Controller
{
    const FILE_IMG_DIR = 'storage/uploads/images/';
    const FILE_TMP_DIR = 'storage/uploads/temp/';

    /**
     * 图片上传，这里是先上传到零时目录，等点击添加商品按钮再把图片转移到正式目录并修改数据库
     *
     * @param Request $request
     * @param ImageRepository $imageRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request, ImageRepository $imageRepository)
    {
        if($request->hasFile('images')){
            $data = [];
            foreach ($request->file('images') as $img) {
                $temp['origin_name'] = $img->getClientOriginalName();
                $temp['ext'] = $img->getClientOriginalExtension();
                $mimeTye = $img->getMimeType();
                $removeName = $this->getUniqueName() . '.' . $temp['ext'];
                $img->move(self::FILE_TMP_DIR, $removeName);
                $temp['size'] = $img->getSize();
                $temp['path'] = self::FILE_TMP_DIR . $removeName;

                $data[] = $temp;
            }
            $this->result['data'] = $imageRepository->addImage($data);
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
    public function delete(Request $request, ImageRepository $imageRepository)
    {
        $id = intval($request->id);
        if ($id <= 0 || ! $imageRepository->delete($id)) {
            $this->result['code'] = 1;
        }

        return response()->json($this->result);
    }
}
