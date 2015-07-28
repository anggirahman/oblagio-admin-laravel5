<?php

namespace oblagio\Http\Controllers\Modules\Obgl;

use Illuminate\Http\Request;

use oblagio\Http\Requests;
use oblagio\Http\Controllers\Controller;
use oblagio\Models\Menu;
use Validator;
use oblagio\Helpers\Site;
use oblagio\Helpers\Scaffolding;

class DefaultController extends Controller
{
    
  public function __construct()
  {
      $this->model = new Menu;
  }
  
  public function getIndex()
  {
        $model = Menu::whereParentId(0)->orderBy('order', 'asc')->get();
        return view('Modules.OblagioGenerator.default.index' , ['model' => $model]);
  }
  
  public function getCreate()
  {
    $listParent =  Menu::whereParentId(0)->lists('title' , 'id');
    return view('Modules.OblagioGenerator.default.form' ,[
       'listParent' => $listParent 
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
   
   public function getTes()
   {
     // echo Scaffolding::buttons(['create' , 'update']);
        echo Scaffolding::buttons(['update'] , 4);
   }
   
 
}
