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
    public function insert($lastid,$organization_id,$partner_name,$partner_address){
        $unixTimeStamp = Carbon::now()->toDateTimeString();
        DB::connection('mysql')->insert("INSERT INTO partner(partner_id, organization_id,partner_name, partner_address, partner_type, created_at, updated_at) 
        VALUES (?,?,?,?,?,?,?)",[$lastid,$organization_id,$partner_name,$partner_address,"customer",$unixTimeStamp,$unixTimeStamp]);
    }
    public function select($organization_id){
        return DB::connection('mysql')->select("SELECT * FROM organizations
        INNER JOIN `partner` ON organizations.id = `partner`.organization_id
        WHERE organizations.id = ?;
        ",[$organization_id]);
    }
    public function selectlastid($organization_id){
        return DB::connection('mysql')->select("SELECT partner_id FROM partner WHERE organization_id = ? ORDER BY partner_id DESC LIMIT 1;",[$organization_id]);
    }
}
