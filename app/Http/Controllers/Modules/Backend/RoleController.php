<?php namespace oblagio\Http\Controllers\Modules\Backend;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use oblagio\Http\Requests;
use oblagio\Http\Controllers\Controller;
use Validator;
use oblagio\Helpers\Site;
use oblagio\Models\Role;
use oblagio\Helpers\Scaffolding;
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
   //     $validator = Validator::make($request->all());
        
        
    }
    
    public function getDelete($id)
    {
        $model = Role::find($id);
        if($model === null)
        {
           return redirect('/404');
        }else{
        
            $model->delete();
            \Session::flash('message' , 'Data Has Been Deleted');
            return Redirect()->back();
        }
      
    }
}
