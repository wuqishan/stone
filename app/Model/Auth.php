<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    protected $table = 'auth';

    public $timestamps = true;

    protected $primaryKey = 'id';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $fillable = array('title', 'navigation_id', 'auth');
}
