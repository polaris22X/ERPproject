<?php

namespace App\Http\Controllers;
use App\organization;
use App\report;
use Illuminate\Http\Request;

class reportController extends Controller
{
    public function profit(Request $request){
        $userlevel_id = $request->session()->get('userlevel_id');
        if($userlevel_id != 1){
            return redirect()->action('organizationController@index');
        }
        $id = $request->session()->get('organization_id');
        $organization = new organization();
        $organizations = $organization->getorganization($id);
        $report = new report();
        $incomes = $report->sumincome($id);
        $expensess = $report->sumexpenses($id);
        return view('report/profit')->with(compact('organizations','incomes','expensess'));
    }
    public function profit1month(Request $request){
        $userlevel_id = $request->session()->get('userlevel_id');
        if($userlevel_id != 1){
            return redirect()->action('organizationController@index');
        }
        $id = $request->session()->get('organization_id');
        $organization = new organization();
        $organizations = $organization->getorganization($id);
        $report = new report();
        $incomes = $report->sumincome1month($id);
        $expensess = $report->sumexpenses1month($id);
        return view('report/profit1month')->with(compact('organizations','incomes','expensess'));
    }
    public function profit3month(Request $request){
        $userlevel_id = $request->session()->get('userlevel_id');
        if($userlevel_id != 1){
            return redirect()->action('organizationController@index');
        }
        $id = $request->session()->get('organization_id');
        $organization = new organization();
        $organizations = $organization->getorganization($id);
        $report = new report();
        $incomes = $report->sumincome3month($id);
        $expensess = $report->sumexpenses3month($id);
        return view('report/profit3month')->with(compact('organizations','incomes','expensess'));
    }
}
