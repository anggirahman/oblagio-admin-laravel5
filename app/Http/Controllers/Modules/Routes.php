<?php
use oblagio\Helpers\Site;
use oblagio\Models\Menu;

$menu = Menu::where('controller' , '!=' , '#')->get();
Route::get(Site::routeGenerator() , 'Modules\Obgl\DefaultController@getIndex');
Route::get(Site::routeBackend() , 'Modules\Backend\DefaultController@getIndex');
Route::controller(Site::routeGenerator()."/default" , 'Modules\Obgl\DefaultController');
foreach($menu as $row)
{
    	Route::controller(Site::routeBackend()."/".Site::aliasUrl($row->title) , $row->controller);
}


