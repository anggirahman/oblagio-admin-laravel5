<?php
    use oblagio\Helpers\Site; 
   // print_r($errors);
?>
@extends('layouts.backend')
@section('content')
<div class="pageheader">
    
    <div class="pageicon"><span class="iconfa-table"></span></div>
    <div class="pagetitle">
        <h1>Form</h1>
    </div>
</div><!--pageheader-->
        
        <div class="maincontent">
            <div class="maincontentinner">
                  <div class="widgetbox box-inverse">
                        <h4 class="widgettitle">Form Bordered</h4>
                        <div class="widgetcontent nopadding">
                            {!! Form::model($model , ['class' => 'stdform stdform2']) !!}
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
                                            {!! Form::text('title' ,null , ['class' => 'input-xxlarge'] ) !!}
                                           &nbsp; <span class = 'errorMessage'>{{ $errors->first('title') }}</span>
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