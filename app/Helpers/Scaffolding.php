<?php namespace oblagio\Helpers;
    
    use oblagio\Helpers\Site;
    use HTML;
    use Form;
    use Request;
    class Scaffolding
    {
        public static function generateLink($action , $id = "")
        {
               return url($generateLink = Site::main()['routeBackend']."/".Site::aliasUrl(Request::segment(2))."/".$action."/".$id);
        }
        
        public static function buttons($actions = [] ,  $id , $boolean = "" )
        {
            
                if( in_array('view' , $actions) || in_array('update' , $actions) || in_array('delete' , $actions)  )
                {
                    $str = "";

                    foreach($actions as $row)
                    {

                        $generateLink = self::generateLink($row , $id);

                        if($row == 'update')
                        {

                          $buttonUpdate = "<a href = '".$generateLink."' class = 'btn btn-primary'><i class=\"icon-pencil icon-white\"></i></a>";
                          $str .= " ".$buttonUpdate." ";

                        }elseif($row == 'delete'){
                          $buttonDelete = "<a href = '".$generateLink."' onclick = 'return confirm(\"are you sure want to delete this item ?\")' class = 'btn btn-primary'><i class=\"icon-trash icon-white\"></i></a>";
                          $str .= " ".$buttonDelete." ";


                        }elseif($row == 'view'){
                          $buttonView = "<a href = '".$generateLink."' class = 'btn btn-primary'><i class=\"icon-search icon-white\"></i></a>";
                          $str .= " ".$buttonView." ";
                        }


                    }


                    if($boolean == '')
                    {
                     return $str;
                    }elseif($boolean=='field'){
                        return $actions;
                    }

                }else{    
                    return 'error di method Scaffolding::buttons($actions[] , $id)';
                }
           
        }
        
        
        public static function searchForm()
        {
            $txt =  "<div style = 'margin-left:80%;'>";
                $txt .= Form::open(['method' => 'get']);
                   $txt .=  Form::text('search' , null , ['onblur' => 'return submit();'] );
                $txt .= Form::close();
            $txt .= "</div>";
            
            return $txt;
        }
        
        public static function onlyTable($model , $field = [] , $buttons = [] ,  $search = [] , $primaryKey , $pageSize = "")
        {
            
            // get Header Table From array $field
            $thHeader = "";
            foreach($field as $row)
            {
                $thHeader .= "<th>".ucfirst($row)."</th>";
            }
            //
            
            // set page size pagination
                (empty($pageSize)) ? $pager = 10 : $pager = $pageSize;
            //
            // get data from db <td>
            $td = "";
            $no = 0;
             foreach($search as $rowS)
            {
               $model->orWhere($rowS , 'like' , '%'.@$_GET['search'].'%');
            }
            $modelAll = $model->paginate($pager);
            
            foreach($modelAll as $rowModel)
            {
                $no++;
                $td.="<tr>";
                    $td .= "<td>".$no."</td>";
                        foreach($field as $value)
                        {
                            $td .= "<td>".$rowModel[$value]."</td>";
                        }
                    $td .= "<td>".self::buttons($buttons , $rowModel[$primaryKey] )."</td>";
                    
                $td.="</tr>";
            }
                
            if(count($search) > 0)
            {
                $header = self::searchForm();
            }else{
                $header = 'dakocan';
            }
           
            $header .= "<table class='table responsive'>
                    <thead>
                        <tr>
                            <th>No</th>
                            ".$thHeader."
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        ".$td."
                    </tbody>
                </table>";
                $header .= '<div class = "pagination pagination-left">'.str_replace("/?","?",$modelAll->render())."</div>";
                
            return $header;
        }
        
        public static function tableWithPage($model , $field = [] , $actions = []  , $search = [] , $primaryKey , $pageSize = "")
        {
            $onlyTable = self::onlyTable($model , $field , $actions , $search , $primaryKey , $pageSize);
           
            if(in_array('create' , $actions))
            {
                $link = self::generateLink('create');
                $buttonCreate =  '<a href = "'.$link.'" class = "btn btn-primary">Add</a>';
            }else{
                $buttonCreate =  '';
            }
            
            if(\Session::has('message'))
            {
               $flash = ' <div class="alert alert-info">
				'.\Session::get('message').'
			</div>';
            }else{
               $flash = "";
            }
            
            
            $txt =  '<div class="pageheader">
            <div class="pageicon"><span class="iconfa-table"></span></div>
                 <div class="pagetitle">
                     <h5>List</h5>
                     <h1>'.ucfirst(Request::segment(2)).'</h1>
                 </div>
             </div><!--pageheader-->
             
             <div class="maincontent">
                 
                 <div class="maincontentinner">
                    '.$flash.'
                    <div>
                             '.$buttonCreate.'
                    </div>
                    <br/>
                   
                   '.$onlyTable.'

                 </div><!--maincontentinner-->
             </div><!--maincontent-->';
           
              return $txt;
        }
        
        public static function widgetOnlyTable($arr)
        {
            return self::onlyTable($arr['model'] , $arr['field'] , $arr['buttons']  , $arr['search'] , $arr['primaryKey'], $arr['pageSize']);
        }
        
        public static function widgetTableWithPage($arr)
        {
          
            return self::tableWithPage($arr['model'] , $arr['field'] , $arr['buttons']  , $arr['search'] , $arr['primaryKey'] , $arr['pageSize'] );
        }
        
        
    }