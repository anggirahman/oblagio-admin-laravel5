<?php

namespace oblagio\Models;

use Illuminate\Database\Eloquent\Model;
use Request;

class Role extends Model
{
    public $guarded = [];
    
    
    public function rules()
    {
        $uri = Request::segment(3);
        
        if($uri == 'create')
        {
            return ['title' => 'required|alpha|unique:roles'];
        
        }elseif($uri == 'update'){
            return ['title' => 'required|alpha|unique:roles,id,'.Request::segment(4)];
        }
    }
}
