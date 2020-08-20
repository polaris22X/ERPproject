<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use auth;
use Carbon\Carbon;
class product extends Model
{
    protected $fillable = [
        'product_id', 'organization_id','product_name','stock'
    ];
    public function insert($lastid,$organization_id,$product_name,$product_description){
        $unixTimeStamp = Carbon::now()->toDateTimeString();
        DB::connection('mysql')->insert("INSERT INTO product(product_id, organization_id,product_name, product_description, stock, created_at, updated_at) 
        VALUES (?,?,?,?,?,?,?)",[$lastid,$organization_id,$product_name,$product_description,0,$unixTimeStamp,$unixTimeStamp]);
    }
    public function select($organization_id){
        return DB::connection('mysql')->select("SELECT * FROM organizations
        INNER JOIN product ON organizations.id = product.organization_id
        WHERE organizations.id = ?;
        ",[$organization_id]);
    }
    public function selectlastid(){
        return DB::connection('mysql')->select("SELECT MAX(product_id) as 'lastid' FROM `product`");
    }
}
