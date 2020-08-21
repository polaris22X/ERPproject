<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use auth;
use Carbon\Carbon;

class income extends Model
{
    public function insert($lastid,$organization_id,$product_id,$product_price,$product_amount,$partner_id,$partner_address){
        $unixTimeStamp = Carbon::now()->toDateTimeString();
        DB::connection('mysql')->insert("INSERT INTO `income`(`income_id`, `organization_id`, `product_id`, `saleprice`, `amount`, `partner_id`, `address`, `status`, `created_at`, `updated_at`) 
        VALUES (?,?,?,?,?,?,?,?,?,?)",[$lastid,$organization_id,$product_id,$product_price,$product_amount,$partner_id,$partner_address,0,$unixTimeStamp,$unixTimeStamp]);
    }
    public function selectlastid($organization_id){
        return DB::connection('mysql')->select("SELECT income_id FROM income WHERE organization_id = ? ORDER BY income_id DESC LIMIT 1;",[$organization_id]);
    }
}
