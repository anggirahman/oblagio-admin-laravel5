<?php

use Illuminate\Database\Seeder;
 use oblagio\Models\Menu;
class menus_table_seeder extends Seeder
{
    
   

    public function run()
    {
            DB::table('menus')->truncate();
            $model = new Menu;
    	// start security modules
            
            $arrParentSecurity =  [
            	'parent_id' => 0,
            	'title' => 'Security',
            	'controller' => '#',
            	'order' => 19 
            ];

            $parentSecurity = $model->create($arrParentSecurity);

    	        $arrChildRole =  [
    	        	'parent_id' => $parentSecurity->id,
    	        	'title' => 'Role',
    	        	'controller' => 'Modules\Backend\RoleController',
    	        	'order' => 1 
    	        ];

    	        $childRole = $model->create($arrChildRole);
	   

        //


        // start default / dashboard modules
             $arrParentDefault =  [
            'parent_id' => 0,
            'title' => 'Dashboard',
            'controller' => 'Modules\Backend\DefaultController',
            'order' => 1 
            ];

            $parentDefault = $model->create($arrParentDefault);
        //
            
     
	        
    }
}
