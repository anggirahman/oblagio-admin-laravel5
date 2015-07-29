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
            return ['title' => 'required|regex:[A-Za-z ]|unique:roles'];
        
        }elseif($uri == 'update'){
            $model = $this->find(Request::segment(4));
            return ['title' => 'required|regex:[A-Za-z ]|unique:roles,title,'.$model->id];
        }
    }
    
    public function messages()
    {
        return [
            'regex' => ':attribute harus huruf !'
        ];
    }
}
