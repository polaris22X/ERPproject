<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\organization;
class incomeController extends Controller
{
    public function index(Request $reqeust){
        $id = $reqeust->session()->get('organization_id');
        $organization = new organization();
        $data = $organization->getorganization($id);
        return view('income/incomemenu')->with('organizations',$data);;
    }
}
