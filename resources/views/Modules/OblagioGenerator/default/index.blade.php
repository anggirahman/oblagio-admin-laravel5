<?php 
	use oblagio\Models\Menu;
	use oblagio\Helpers\Site;
  use oblagio\Helpers\OHtml;
  use oblagio\Helpers\Scaffolding;
 ?>
@extends('layouts.backend')
@section('content')

	<div class="pageheader">
            
            <div class="pageicon"><span class="iconfa-table"></span></div>
            <div class="pagetitle">
                <h5>List</h5>
                <h1>Oblagio Generator</h1>
            </div>
        </div><!--pageheader-->
        
        <div class="maincontent">
            <div class="maincontentinner">
                <div>
               		<?=  HTML::link('obgl/default/create' , 'Create' , ['class' => 'btn btn-primary'] ) ?>
               </div>
               <br/>
               <h4 class="widgettitle">List Of Menu</h4>
              
               <table class="table responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Controller</th>
                            <th>Order</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @yield($no = 0)
                    @foreach($model as $row)
                    @yield($no++)   
                        <tr>
                           <td>{{ $no }}</td>
                           <td>{{ $row->title }}</td>
                           <td>{{ $row->controller }}</td>
                           <td>{{ $row->order }}</td>
                           <td></td>
                        </tr>
                   			
                        <?php $modelChild = Menu::whereParentId($row->id)->get() ?>
                   		
                      	@yield($noC = 0)
                        @foreach($modelChild as $rowC)
                        @yield($noC++)
                          <tr>
                           <td style="text-align:center">{{ $no.".".$noC }}</td>
                           <td>{{ $rowC->title }}</td>
                           <td>{{ $rowC->controller }}</td>
                           <td>{{ $rowC->order }}</td>
                           <td></td>
                        </tr>

                        @endforeach

                     @endforeach
                    </tbody>
                </table>
                
            </div><!--maincontentinner-->
        </div><!--maincontent-->
@endsection