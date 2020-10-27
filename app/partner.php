<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class partner extends Model
{
    protected $fillable = [
        'partner_id', 'organization_id','partner_name','partner_address','partner_type'
    ];
    public function insert($lastid,$organization_id,$partner_name,$partner_address,$partner_tel,$partner_email){
        $unixTimeStamp = Carbon::now()->toDateTimeString();
        DB::connection('mysql')->insert("INSERT INTO partner(partner_id, organization_id,partner_name, partner_address, partner_type, partner_tel, partner_email, created_at, updated_at) 
        VALUES (?,?,?,?,?,?,?,?,?)",[$lastid,$organization_id,$partner_name,$partner_address,"customer",$partner_tel,$partner_email,$unixTimeStamp,$unixTimeStamp]);
    }
    public function select($organization_id){
        return DB::connection('mysql')->select("SELECT * FROM organizations
        INNER JOIN `partner` ON organizations.id = `partner`.organization_id
        WHERE organizations.id = ?;
        ",[$organization_id]);
    }
    public function selectwithid($organization_id,$partner_id){
        return DB::connection('mysql')->select("SELECT * FROM organizations
        INNER JOIN `partner` ON organizations.id = `partner`.organization_id
        WHERE organizations.id = ? AND partner.partner_id =  ?",[$organization_id,$partner_id]);
    }
    public function selectlastid($organization_id){
        return DB::connection('mysql')->select("SELECT partner_id FROM partner WHERE organization_id = ? ORDER BY partner_id DESC LIMIT 1;",[$organization_id]);
    }
    public function updatedo($organization_id,$partner_id,$partner_name,$partner_address,$partner_tel,$partner_email,$uinxTimeStamp){
       DB::connection('mysql')->update("UPDATE partner SET partner_name = ? , partner_address = ?,partner_tel = ?,partner_email = ?,updated_at = ? WHERE organization_id = ? AND partner_id = ?;",[$partner_name,$partner_address,$partner_tel,$partner_email,$uinxTimeStamp,$organization_id,$partner_id]);
    }
}
