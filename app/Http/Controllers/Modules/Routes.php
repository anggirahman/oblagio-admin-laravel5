<?php
use oblagio\Helpers\Site;
use oblagio\Models\Menu;

$menu = Menu::where('controller' , '!=' , '#')->get();
Route::get(Site::main()['routeGenerator'] , 'Modules\Obgl\DefaultController@getIndex');
Route::controller(Site::main()['routeGenerator']."/default" , 'Modules\Obgl\DefaultController');
foreach($menu as $row)
{
    	Route::controller(Site::main()['routeBackend']."/".Site::aliasUrl($row->title) , $row->controller);
}


