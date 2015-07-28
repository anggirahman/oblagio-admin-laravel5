<?php
    use oblagio\Models\Menu;
    use oblagio\Helpers\Site;
?>

<div class="leftpanel">
        
        <div class="leftmenu"> 

            <ul class="nav nav-tabs nav-stacked">
            	<li class="nav-header">Navigation</li>

                <?php
                   $modelParent = Menu::whereParentId(0)->orderBy('order' , 'asc')->get();

                   foreach($modelParent as $parent)
                   {

                        if($parent->controller == '#')
                        {
                            $cekUrl = '#';
                        }else{
                            $cekUrl =  Site::main()['routeBackend']."/".Site::aliasUrl($parent->title);
                        }
                       
                        $setChild = Menu::whereParentId($parent->id)->orderBy('order' , 'asc');
                        $countChild = clone $setChild;
                        $dropdown = $countChild->count() > 0 ? 'dropdown' : '';

                        echo "<li class = '".$dropdown."'>";
                            
                            echo  HTML::link($cekUrl, $parent->title);

                            if($countChild->count() > 0)
                            {
                                echo "<ul>";
                                    
                                    $modelChild = clone $setChild;
                                    foreach($modelChild->get() as $child){

                                        echo "<li>";

                                            echo  HTML::link(Site::main()['routeBackend']."/".Site::aliasUrl($child->title), $child->title);

                                        echo "</li>";

                                    }
                                echo "</ul>";
                            }

                        echo "</li>";    
                   }

                   
                ?>
            </ul>
        </div><!--leftmenu-->
        
    </div><!-- leftpanel -->