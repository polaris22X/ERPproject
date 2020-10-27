<?php

namespace App\Http\Controllers;
use App\user_organization;
use App\organization;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function userlist(Request $request){
        $userlevel_id = $request->session()->get('userlevel_id');
        if($userlevel_id != 1){
            return redirect()->action('organizationController@index');
        }
        $id = $request->session()->get('organization_id');
        $organization = new organization();
        $organizations = $organization->getorganization($id);
        $user = new user_organization();
        $users = $user->selectlistuser($id);
        return view('user/list')->with(compact('organizations','users'));
    }
    public function insertform(Request $request){
        $userlevel_id = $request->session()->get('userlevel_id');
        if($userlevel_id != 1){
            return redirect()->action('organizationController@index');
        }
        $id = $request->session()->get('organization_id');
        $organization = new organization();
        $organizations = $organization->getorganization($id);
        $level = new user_organization();
        $levels = $level->getalllevel();
        return view('user/insert')->with(compact('organizations','levels'));
    }
    public function insert(Request $request){
        $userlevel_id = $request->session()->get('userlevel_id');
        if($userlevel_id != 1){
            return redirect()->action('organizationController@index');
        }
        $id = $request->session()->get('organization_id');
        $level = new user_organization();
        $level->insertuser($id);
        return redirect()->action('userController@userlist');
    }
}
