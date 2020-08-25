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
        DB::connection('mysql')->insert("INSERT INTO `income`(`income_id`, `organization_id`, `product_id`, `saleprice`, `amount`, `partner_id`, `address`, `status_id`, `created_at`, `updated_at`) 
        VALUES (?,?,?,?,?,?,?,?,?,?)",[$lastid,$organization_id,$product_id,$product_price,$product_amount,$partner_id,$partner_address,0,$unixTimeStamp,$unixTimeStamp]);
    }
    public function selectlastid($organization_id){
        return DB::connection('mysql')->select("SELECT income_id FROM income WHERE organization_id = ? ORDER BY income_id DESC LIMIT 1;",[$organization_id]);
    }
    public function select($organization_id){
       
        return DB::connection('mysql')->select("SELECT income.income_id,`partner`.partner_name ,income.created_at,SUM(income.saleprice * income.amount) as 'sum' 
        FROM `income` INNER JOIN `partner` ON `partner`.partner_id = income.partner_id AND `partner`.organization_id = income.organization_id WHERE income.organization_id = ? 
        GROUP BY income.income_id,`partner`.partner_name,income.created_at",[$organization_id]);
    }

    public function getdata($organization_id,$income_id){
       
       return DB::connection('mysql')->select("SELECT * FROM income
        WHERE income.organization_id = ? AND income.income_id = ? ",[$organization_id,$income_id]);
   }

   public function getpartner($organization_id,$income_id){
       
       return DB::connection('mysql')->select("SELECT * FROM income
        WHERE income.organization_id = ? AND income.income_id = ? LIMIT 1;",[$organization_id,$income_id]);
   }
}
