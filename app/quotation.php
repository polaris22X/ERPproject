<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class quotation extends Model
{
    public function getreadytoquotation($organization_id){
        return DB::connection('mysql')->select("SELECT count(*) as 'readytoquotation' FROM (SELECT income_id FROM income WHERE organization_id = ? AND status_id = 0 GROUP BY income_id) AS sub;",[$organization_id]);
    } 
}
