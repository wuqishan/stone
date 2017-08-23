<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsImages extends Model
{
    protected $table = 'goods_images';

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = array('goods_id', 'images_id');
}
