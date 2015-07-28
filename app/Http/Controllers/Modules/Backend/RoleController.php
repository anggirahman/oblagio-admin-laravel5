<?php namespace oblagio\Http\Controllers\Modules\Backend;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use oblagio\Http\Requests;
use oblagio\Http\Controllers\Controller;
use Validator;
use oblagio\Helpers\Site;
use oblagio\Models\Role;
use oblagio\Helpers\Scaffolding;
use Redirect;
class RoleController extends Controller
{
    public function getIndex()
    {
       return view('Modules.Backend.role.index' , [] );
    }
    
    public function getCreate()
    {
        $model = new Role;
        return view('Modules.Backend.role.form' , [
            'model' => $model
        ]);
    }
    
    public function postCreate(Request $request)
    {
        $model = new Role;
        $validator = Validator::make($request->all() , $model->rules);
        if($validator->fails())
        {
            return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
        }
        
        $model->create($request->all());
        
        \Session::flash('message' , 'Data Has Been Saved');
         return Site::redirectAction('index');
        
        
    }
    
    public function getUpdate($id)
    {
        $model = Role::find($id);
        return view('Modules.Backend.role.form' , [
            'model' => $model
        ]);
    }
    
    public function postUpdate(Request $request , $id)
    {
        $model = Role::find($id);
        $validator = Validator::make($request->all() , $model->rules);
        if($validator->fails())
        {
            return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
        }
        
        $model->create($request->all());
        
        \Session::flash('message' , 'Data Has Been Saved');
         return Site::redirectAction('index');
    }
    
    
    public function getDelete($id)
    {
        $model = Role::find($id);
        if($model === null)
        {
           return \Redirect('/404');
        }else{
        
            $model->delete();
            \Session::flash('message' , 'Data Has Been Deleted');
            return Redirect()->back();
        }
      
    }
}
