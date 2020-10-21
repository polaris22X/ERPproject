<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

class report extends Model
{
    public function sumincome($organization_id){
        return DB::connection('mysql')->select("SELECT SUM(saleprice * amount)AS 'sumincome' FROM `income` WHERE status_id >= 3 AND organization_id = ?",[$organization_id]);
    }
    public function sumexpenses($organization_id){
        return DB::connection('mysql')->select("SELECT SUM(saleprice * amount)AS 'sumexpenses' FROM `expenses` WHERE status_id >= 1 AND organization_id = ?",[$organization_id]);
    }
}
