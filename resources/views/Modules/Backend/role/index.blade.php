<?php 
	use oblagio\Helpers\Scaffolding;
  use oblagio\Models\Role;
 ?>
@extends('layouts.backend')
@section('content')
  <?php 
    echo Scaffolding::widgetTableWithPage([
      'primaryKey' => 'id',
      'model' => Role::orderBy('id' , 'desc'),
      'field' => ['id' , 'title'],
      'search' => ['title'],
      'buttons' => ['create' , 'update' , 'delete'],
      'pageSize' => 10,
    ]);
  ?>
@endsection