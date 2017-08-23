<?php

namespace App\Repositories;

use App\Model\Images;

class ImageRepository extends Repository
{
    public function addImage($data)
    {
        $result = [];
        foreach ($data as $v) {
            $v['img_id'] = Images::create($v)->id;
            $result[] = $v;
        }

        return $result;
    }
}