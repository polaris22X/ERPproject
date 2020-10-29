<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use auth;
use Carbon\Carbon;

class organization extends Model
{
    protected $fillable = [
        'organization_name', 'organization_address'
    ];

    public function insert($lastid,$organization_name,$organization_address,$organization_tel,$organization_email,$organization_taxid){
        $unixTimeStamp = Carbon::now()->toDateTimeString();
        DB::connection('mysql')->insert("INSERT INTO organizations(id,organization_name,organization_address,organization_tel,organization_email,organization_taxid,created_at, updated_at) 
        VALUES (?,?,?,?,?,?,?,?)",[$lastid,$organization_name,$organization_address,$organization_tel,$organization_email,$organization_taxid,$unixTimeStamp,$unixTimeStamp]);
    }
    public function select(){
        $id = Auth::id();
        return DB::connection('mysql')->select("SELECT * FROM users 
        INNER JOIN user_organization ON users.id = user_organization.user_id
        INNER JOIN organizations on user_organization.organization_id = organizations.id
        WHERE users.id = ?;
        ",[$id]);
    }
    public function selectlastid(){
        return DB::connection('mysql')->select("SELECT MAX(id) as 'lastid' FROM `organizations`");
    }
    public function getorganization($id){
        return DB::connection('mysql')->select("SELECT * FROM organizations where id = ?",[$id]);
    }

    public function updatedo($organization_id,$organization_name,$organization_address,$organization_tel,$organization_email,$organization_taxid){
        $uinxTimeStamp = Carbon::now()->toDateTimeString();
        DB::connection('mysql')->update("UPDATE organizations SET organization_name = ? , organization_address = ?, organization_tel = ?,organization_email = ? , organization_taxid = ? ,updated_at = ? WHERE id = ?;",[$organization_name,$organization_address,$organization_tel,$organization_email,$organization_taxid,$uinxTimeStamp,$organization_id]);
    }
}
