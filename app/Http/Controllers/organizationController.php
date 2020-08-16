<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\organization;
use App\user_organization;
use Illuminate\Support\Facades\Auth;

class organizationController extends Controller
{
    public function index(){
        $organization = new organization();
        $data = $organization->select();
        return view('organization/home')->with('organizations',$data);
    }
    public function menu(Request $reqeust){
        $id = $reqeust->session()->get('organization_id');
        $organization = new organization();
        $data = $organization->getorganization($id);
        return view('organization/main')->with('organizations',$data);
    }

    public function main(Request $reqeust,$id)
    {
        $reqeust->session()->put('organization_id',$id);
        return redirect()->action('organizationController@menu');
       
    }

    public function add(){
        return view('organization/addorganization');
    }
    public function status(){
        return view('organization/status');
    }
    public function store(){
        request()->validate([
            'organization_name' => 'required',
            'organization_address' => 'required'
        ]);
        $organization_name = request()->input('organization_name');
        $organization_address = request()->input('organization_address');
        $organization = new organization();
        $user_organization = new user_organization();
        $data = $organization->selectlastid();
        foreach($data as $id){
            $lastid = $id->lastid;
        }
        if($lastid == null){
            $lastid = 1;
        }
        else{
            $lastid = $lastid + 1;
        }
        $organization->insert($lastid,$organization_name,$organization_address);
        $user_organization->insert($lastid);
        $data = $organization->select();
        return view('organization/status');

    }

}
