<?php

namespace App\Http\Controllers;
use App\organization;
use App\quotation;
use Illuminate\Http\Request;

class quotationController extends Controller
{
    public function index(Request $reqeust){
        $id = $reqeust->session()->get('organization_id');
        $organization = new organization();
        $quotation = new quotation();
        $organizations = $organization->getorganization($id);
        $readytoquotation = $quotation->getreadytoquotation($id);
        return view('income/quotation/list')->with(compact(['organizations','readytoquotation']));
    }
}
