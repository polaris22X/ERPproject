<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\organization;
use App\user_organization;
use App\income;
use App\quotation;
use Illuminate\Support\Facades\Auth;

class organizationController extends Controller
{
    public function index(Request $request){
        $organization = new organization();
        $data = $organization->select();
        return view('organization/home')->with('organizations',$data);
    }
    public function menu(Request $request){
        $userlevel_id = $request->session()->get('userlevel_id');
        if($userlevel_id != 1){
            return redirect()->action('organizationController@index');
        }
        $id = $request->session()->get('organization_id');
        $income = new income();
        $quotation = new quotation();
        $organization = new organization();
        $organizations = $organization->getorganization($id);
        $readytoquotation = $income->getreadytoquotation($id);
        $readytoaccept = $income->getreadytoaccept($id);
        return view('organization/main')->with(compact(['organizations','readytoquotation','readytoaccept']));
    }

    public function main(Request $request,$id)
    {
        $request->session()->put('organization_id',$id);
        $user_organization = new user_organization();
        $user_levels = $user_organization->selectlevel($id);
        foreach ($user_levels as $user_level) {
            $level = $user_level->userlevel_id;
        }
        if($level == 1){
            $request->session()->put('userlevel_id',$level);
            return redirect()->action('organizationController@menu');
        }
        if($level == 2){
            $request->session()->put('userlevel_id',$level);
            return redirect()->action('saleController@index');
        }
        
       
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
            'organization_address' => 'required',  
        ]);
        $organization_name = request()->input('organization_name');
        $organization_address = request()->input('organization_address');
        $organization_tel = request()->input('organization_tel');
        $organization_email = request()->input('organization_email');
        $organization_taxid = request()->input('organization_taxid');
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
        $organization->insert($lastid,$organization_name,$organization_address,$organization_tel,$organization_email,$organization_taxid);
        $user_organization->insert($lastid);
        $data = $organization->select();
        return view('organization/status');

    }

}
