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
            $this->result['data'] = $imageRepository->addImage($data);
        }

        return response()->json($this->result);
    }

    public function delete(Request $request, ImageRepository $imageRepository)
    {

        $id = intval($request->id);

        if ($id <= 0 || ! $imageRepository->delete($id)) {
            $this->result['code'] = 1;
        }

        return response()->json($this->result);
    }
}
