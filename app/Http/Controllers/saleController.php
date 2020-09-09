<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\organization;
use App\user_organization;

class saleController extends Controller
{
    public function index(Request $request){
        $userlevel_id = $request->session()->get('userlevel_id');
        if($userlevel_id != 2){
            return redirect()->action('organizationController@index');
        }
        $id = $request->session()->get('organization_id');
        $organization = new organization();
        $data = $organization->getorganization($id);
        return view('salesman/menu')->with('organizations',$data);
    }
}
