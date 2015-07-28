<?php

namespace oblagio\Http\Controllers\Modules\Backend;

use Illuminate\Http\Request;

use oblagio\Http\Requests;
use oblagio\Http\Controllers\Controller;

class DefaultController extends Controller
{
   
    public function getIndex()
    {
       return View('Modules.Backend.default.index');
    }

   
}
