<?php

namespace App\Http\Controllers;
use App\partner;
use Illuminate\Http\Request;

class partnerController extends Controller
{
    
    public function store(Request $reqeust){
        request()->validate([
            'partner_name' => 'required',
            'partner_address' => 'required'
        ]);
        $partner_name = request()->input('partner_name');
        $partner_address = request()->input('partner_address');
        $partner_tel = request()->input('partner_tel');
        $partner_email = request()->input('partner_email');
        $organization_id = $reqeust->session()->get('organization_id');
        $partner = new partner();
        $data = $partner->selectlastid($organization_id);
        if($data){
            foreach($data as $id){
            $lastid = $id->partner_id;
            }
        $lastid = $lastid + 1;
        }
        else{
            $lastid = 1; 
        }
        $partner->insert($lastid,$organization_id,$partner_name,$partner_address,$partner_tel,$partner_email );
        $msg = $lastid;
        return response()->json(array('msg'=> $msg), 200);;
        /*if(request()->input('page') == "insert"){
            return redirect()->action('incomeController@insert');
        }
        if(request()->input('page') == "update"){
            $idincome = request()->input('income_id');
            return redirect('income/update/'.$idincome);
        }*/
    }
}
