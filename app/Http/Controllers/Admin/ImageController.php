<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ImageRepository;

class ImageController extends Controller
{
    const FILE_IMG_DIR = 'storage/uploads/images/';

    public function upload(Request $request, ImageRepository $imageRepository)
    {
        $result = ['code' => 0, 'msg' => '', 'data' => []];

        if($request->hasFile('images')){
            $data = [];
            foreach ($request->file('images') as $img) {
                $temp['origin_name'] = $img -> getClientOriginalName();
                $temp['ext'] = $img -> getClientOriginalExtension();
                $mimeTye = $img -> getMimeType();
                $removeName = $this->getUniqueName() . '.' . $temp['ext'];
                $img -> move(self::FILE_IMG_DIR, $removeName);
                $temp['size'] = $img->getSize();
                $temp['path'] = self::FILE_IMG_DIR . $removeName;

                $data[] = $temp;
            }
            $result['data'] = $imageRepository->addImage($data);
        }

        return response()->json($result);
    }

    public function delete(Request $request)
    {
//        $id = $request
    }
}
