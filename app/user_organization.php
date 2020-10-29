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
        DB::connection('mysql')->insert("INSERT INTO user_organization(user_id, organization_id, userlevel_id,created_at, updated_at) 
        VALUES (?,?,?,?,?)",[$user_id,$organization_id,$userlevel_id,$unixTimeStamp,$unixTimeStamp]);
    }
    
    public function insertuser($organization_id,$user_email,$userlevel_id){
        $users =  DB::connection('mysql')->select("select * from users where email = ?",[$user_email]);
        if($users){
        foreach ($users as $user) {
             $user_id = $user->id;
        }
        $unixTimeStamp = Carbon::now()->toDateTimeString();
          DB::connection('mysql')->insert("INSERT INTO user_organization(user_id, organization_id	, userlevel_id,created_at, updated_at) 
        VALUES (?,?,?,?,?)",[$user_id,$organization_id,$userlevel_id,$unixTimeStamp,$unixTimeStamp]);
        return 1;
          }
         else {
               return 0;
         }
    }

    public function edit($organization_id,$user_id,$level_id){
       
        $unixTimeStamp = Carbon::now()->toDateTimeString();
        DB::connection('mysql')->update("UPDATE user_organization SET userlevel_id = ?,updated_at = ? WHERE user_id = ?;"
        ,[$level_id,$unixTimeStamp,$user_id]);
        
    }

   public function selectlevel($organization_id){
        $user_id = Auth::id();
        return DB::connection('mysql')->select("SELECT * FROM `user_organization` WHERE organization_id = ? AND user_id = ?",[$organization_id,$user_id]);
   }
   public function selectlistuser($organization_id){
        $user_id = Auth::id();
        return DB::connection('mysql')->select("SELECT *,users.id as 'user_id',userlevel.id as 'level_id' FROM user_organization
        INNER JOIN `users` ON user_organization.user_id = users.id
        INNER JOIN userlevel ON user_organization.userlevel_id = userlevel.id
        WHERE organization_id = ?;
        ",[$organization_id]);
   }
   public function getalllevel(){
        $user_id = Auth::id();
        return DB::connection('mysql')->select("SELECT * FROM userlevel;");
   }
  
}
