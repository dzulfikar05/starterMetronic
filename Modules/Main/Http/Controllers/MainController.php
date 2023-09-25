<?php

namespace Modules\Main\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; 

class MainController extends Controller
{
    
   
    public function index()
    {
        return view('main::index',[
			'title' => 'Main',
			'content' => ''
		]);
        // return view('main::index');
    }

    public function getPage()
    {
        $userRole = session()->get('userdata.user_role');

        $q1 = DB::table('v_user_roles')->where([
            ['user_role_role_id' ,'=', $userRole],
        ])->orderBy('route_order', 'ASC')->get()->toArray();
        $data = convertArray($q1);
        
        return($data);

    
    }
}
