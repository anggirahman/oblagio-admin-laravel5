<?php
    use oblagio\Helpers\Site; 
?>
@extends('layouts.backend')
@section('content')
<div class="pageheader">
    
    <div class="pageicon"><span class="iconfa-table"></span></div>
    <div class="pagetitle">
        <h5>List</h5>
        <h1>Form</h1>
    </div>
</div><!--pageheader-->
        
        <div class="maincontent">
            <div class="maincontentinner">
                  <div class="widgetbox box-inverse">
                        <h4 class="widgettitle">Form Bordered</h4>
                        <div class="widgetcontent nopadding">
                            {!! Form::open(['class' => 'stdform stdform2']) !!}
                                    <p>
                                        <label>Parent Menu</label>
                                        <span class="field">
                                           {!! Form::select('parent_id' , Site::withEmpty($listParent) , null , ['class' => 'input-xxlarge'] ) !!}
                                           &nbsp; <span class = 'errorMessage'>{{ $errors->first('parent_id') }}</span>
                                        </span>
                                    </p>
                                    
                                    <p>
                                        <label>Title</label>
                                        <span class="field">
                                            {!! Form::text('title' , old('title') , ['class' => 'input-xxlarge'] ) !!}
                                           &nbsp; <span class = 'errorMessage'>{{ $errors->first('title') }}</span>
                                        </span>
                                    </p>
                                    
                                     <p>
                                        <label>Controller</label>
                                        <span class="field">
                                            {!! Form::text('controller' , old('controller') , ['class' => 'input-xxlarge'] ) !!}
                                          &nbsp;   <span class = 'errorMessage'>{{ $errors->first('controller') }}</span>
                                        </span>
                                    </p>
                                    
                                    <p>
                                        <label>Order</label>
                                        <span class="field">
                                            {!! Form::text('order' , old('order') , ['class' => 'input-xxlarge'] ) !!}
                                          &nbsp;   <span class = 'errorMessage'>{{ $errors->first('order') }}</span>
                                        </span>
                                    </p>
                                                            
                                    <p class="stdformbutton">
                                        <button class="btn btn-primary">Submit Button</button>
                                    </p>
                            {!! Form::close() !!}
                        </div><!--widgetcontent-->
                    </div>
                </div>
            </div>

@endsection