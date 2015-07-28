<?php

namespace oblagio\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    public $guarded = [];
   
    public static function rulesValidation()
    {
        $rules = [
            'title' => 'required|unique:menus',
            'controller' => 'required|unique:menus',
            'order' => 'required|integer',
            'parent_id' => 'required',
        ];
        
        return $rules;
    }
    
    
    
}
