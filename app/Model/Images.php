<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'images';

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = array('path', 'size', 'ext', 'origin_name');
}
