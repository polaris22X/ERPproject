<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use auth;
use Carbon\Carbon;


class expenses extends Model
{
    public function insert($lastid,$organization_id,$product_id,$product_price,$product_amount,$partner_id,$partner_address,$unixTimeStamp){
        
        DB::connection('mysql')->insert("INSERT INTO `expenses`(`expenses_id`, `organization_id`, `product_id`, `saleprice`, `amount`, `partner_id`, `address`, `status_id`, `created_at`, `updated_at`) 
        VALUES (?,?,?,?,?,?,?,?,?,?)",[$lastid,$organization_id,$product_id,$product_price,$product_amount,$partner_id,$partner_address,0,$unixTimeStamp,$unixTimeStamp]);
    }
}
