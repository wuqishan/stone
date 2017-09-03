<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    protected $table = 'navigation';

    public $timestamps = true;

    protected $primaryKey = 'id';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $fillable = array('parent_id', 'title', 'icon', 'spread', 'href', 'level', 'order');
}
