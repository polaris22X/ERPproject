<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use auth;
use Carbon\Carbon;

class user_organization extends Model
{   
    protected $fillable = [
        'organization_name', 'organization_address'
    ];

    public function insert($organization_id){
        $user_id = Auth::id();
        $userlevel_id = 1;
        $unixTimeStamp = Carbon::now()->toDateTimeString();
        DB::connection('mysql')->insert("INSERT INTO user_organization(user_id, organization_id	, userlevel_id,created_at, updated_at) 
        VALUES (?,?,?,?,?)",[$user_id,$organization_id,$userlevel_id,$unixTimeStamp,$unixTimeStamp]);
    }
   public function checkuser_organization($user_id){
        return DB::connection('mysql')->select("SELECT * FROM `user_organization` WHERE user_id = ?",[$user_id]);
   }
}
