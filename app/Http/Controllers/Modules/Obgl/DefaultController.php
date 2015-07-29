<?php

namespace oblagio\Http\Controllers\Modules\Obgl;

use Illuminate\Http\Request;

use oblagio\Http\Requests;
use oblagio\Http\Controllers\Controller;
use oblagio\Models\Menu;
use Validator;
use oblagio\Helpers\Site;
use oblagio\Helpers\Scaffolding;
use Redirect;

class DefaultController extends Controller
{
    
  public function __construct()
  {
      $this->model = new Menu;
      $this->listParent = Menu::whereParentId(0)->lists('title' , 'id');
  }
  
  public function getIndex()
  {
        $model = Menu::whereParentId(0)->orderBy('order', 'asc')->get();
        return view('Modules.OblagioGenerator.default.index' , ['model' => $model]);
  }
  
  public function getCreate()
  {
    return view('Modules.OblagioGenerator.default.form' ,[
       'listParent' => $this->listParent ,
        'model' => $this->model
    ]);
  }
  
  
  
   public function postCreate(Request $request)
   {
       $input = $request->all();
       $validator = Validator::make($request->all() , Menu::rulesValidation()  , Site::errorMessages() );
       if($validator->fails())
       {
           return redirect()->back()->withErrors($validator)->withInput();
       }
       
       Menu::create($request->all());
       
       $path = app_path()."\Http\Controllers\\".$request->controller;
       $createFile = fopen($path.".php" , "w");
       $generateController  = Site::generateController($request->controller);
       $write = fwrite($createFile , $generateController);
       fclose($createFile);
       
       return redirect(Site::routeGenerator()."/default/index");
   }
   
   public function getUpdate($id)
  {
    return view('Modules.OblagioGenerator.default.form_update' ,[
       'listParent' => $this->listParent ,
        'model' => $this->model->find($id)
    ]);
  }
  
  public function postUpdate(Request $request , $id)
  {
      $validator = Validator::make($request->all() , ['title' => 'required|alpha|unique:menus,title,'.$id] );
      if($validator->fails())
      {
          return Redirect::back()->withErrors($validator)->withInput();
      }
      
      $model = $this->model->find($id);
      $model->update($request->all());
      return Site::redirectAction('index');
  }
  
  public function getDelete($id)
  {
      $model = Menu::find($id);
      if($model === null)
      {
          return redirect('404');
      }else{
          $path = app_path()."\Http\Controllers\\";
          $controllerPath = $path.$model->controller.".php";
          
          if(file_exists($controllerPath))
          {
              @unlink($controllerPath);
          }
          
          $model->delete();
          \Session::flash('message' , 'Data telah di hapus !');
          return redirect()->back();
      }
  }
 
}
