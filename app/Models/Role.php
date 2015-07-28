<?php

namespace oblagio\Models;

use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    public $guarded = [];
    
    public $rules = [
        'title' => 'required|alpha|unique:roles',
    ];
}
